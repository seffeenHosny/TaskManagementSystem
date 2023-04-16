<?php


namespace App\Services\Helpers;


use App\Models\Otp;
use phpDocumentor\Reflection\Types\This;

class OtpResponse
{
    private ?string $error = null;
    private ?Otp $otp = null;

    public function getError(): ?string
    {
        return $this->error;
    }

    public function setError(?string $error): self
    {
        $this->error = $error;
        return $this;
    }

    public function hasError(): bool
    {
        return !is_null($this->error);
    }


    public function getOtp(): ?Otp
    {
        return $this->otp;
    }


    public function setOtp(?Otp $otp): self
    {
        $this->otp = $otp;
        return $this;
    }
}
