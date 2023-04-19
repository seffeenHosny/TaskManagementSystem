<x-mail::message>
# Introduction

Dear {{$user->name}}
task {{$task->title}}

{{$message}}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
