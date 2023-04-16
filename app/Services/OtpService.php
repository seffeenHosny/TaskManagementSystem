<?php

namespace App\Services;

use App\Models\Otp;
use App\Services\Helpers\OtpResponse;

class OtpService
{
    private function get(string $phone, string $type): ?Otp
    {
        return Otp::query()
            ->where("phone", $phone)
            ->where("type", $type)
            ->first();
    }

    private function create(string $phone, string $type): Otp
    {
        return Otp::query()
            ->firstOrCreate([
                'phone' => $phone,
                "type" => $type,
            ], [
                'resent_left' => 4,
                'expired_at' => now()->addHour(),
                "code" => fake()->randomNumber(4, true),
            ]);
    }


    public function delete(string $phone, string $type)
    {
        Otp::query()
            ->where("phone", $phone)
            ->where("type", $type)
            ->delete();
    }

    public function resend(string $phone, string $type = "register"): OtpResponse
    {
        $otp = $this->get($phone, $type);
        $otpResponse = (new OtpResponse())->setOtp($otp);

        if (!$otp) {
            $otp = $this->create($phone, $type);
        }

        if ($otp->isExpired()) {
            $this->delete($phone, $type);
            $otp = $this->create($phone, $type);
        } elseif ($otp->isExceeded()) { // not expired
            return $otpResponse->setError(__("you have exceeded your tries"));
        } else {
            $otp->decrement("resent_left");
        }

       //GateSms::send($phone , "رمز التحقق للصالة اﻻقتصادية هو $otp->code");

        return $otpResponse->setOtp($otp);
    }


    public function verify(string $phone, string $code, string $type): OtpResponse
    {
        $otp = $this->get($phone, $type);
        $otpResponse = (new OtpResponse())->setOtp($otp);

        if (!$otp) {
            return $otpResponse->setError(__('invalid otp.'));
        }

        if ($otp->isExpired()) {
            return $otpResponse->setError(__('otp is expired'));
        }

        if (!$otp->hasWrongCount()) {
            return $otpResponse->setError(__('you have exceeded your tries'));
        }

        if ($otp->code != $code) {
            $otp->hasWrongCount() ? $otp->decrement("wrong_count") : null;

            return $otpResponse->setError(__('invalid otp'));
        }


        return $otpResponse;
    }
}
