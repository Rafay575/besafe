<?php
// its besfe own helper functions file

use Carbon\Carbon;

function formatDate($date)
{
    return Carbon::parse($date)->format('d-m-Y');
}
function formatDateTime($date)
{
    return Carbon::parse($date)->format('d-m-Y H:i:s');
}