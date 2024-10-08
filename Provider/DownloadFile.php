<?php

namespace App\Provider;

class DownloadFile
{

    public function __construct(public array $pages)
    {
    }

    public function downloadFiles(): array
    {
        $files = [];
        foreach ($this->pages as $page) {
            preg_match_all('/<img .*?src="(.*?)"|<a .*?href="(.*?)"/', $page['content'], $matches);
            $fileUrls = array_merge($matches[1], $matches[2]);
            foreach ($fileUrls as $fileUrl) {
                if ($fileUrl) {
                    $fileUrl = filter_var($fileUrl, FILTER_VALIDATE_URL) ? $fileUrl : rtrim($page['url'], '/') . '/' . ltrim($fileUrl, '/');
                    if (preg_match('/\.(jpg|jpeg|png|pdf|docx|xlsx)$/', $fileUrl)) {
                        $files[] = $fileUrl;
                        $fileContent = @file_get_contents($fileUrl);
                        if ($fileContent !== false) {
                            file_put_contents(basename($fileUrl), $fileContent);
                        }
                    }
                }
            }
        }
        return $files;
    }

}