<?php

function redirect(string $location): void
{
    header('Location: ' . $location, true, 302);
    exit();
}

// Loại bỏ ký tự đặc biệt
function html_escape(string|null $text): string
{
    return htmlspecialchars($text ?? '', ENT_QUOTES, 'UTF-8', false);
}