<?php

return [
    'title' => 'required|string',
    'description' => 'nullable|string',
    'show_server' => ['filled'],
    'button' => ['filled'],
    'title_button' => ['required_with:button'],
    'button_link' => ['required_with:use_play_button'],
    'footer_links' => 'nullable|array',
    'footer_social_twitter' => 'nullable|string',
    'footer_social_discord' => 'nullable|string',
    'footer_social_steam' => 'nullable|string',
    'footer_social_youtube' => 'nullable|string',
    'footer_social_teamspeak' => 'nullable|string',
    'footer_social_instagram' => 'nullable|string',
];
