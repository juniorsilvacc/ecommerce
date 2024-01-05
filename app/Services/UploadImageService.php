<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadImageService
{
    private $path = 'products';

    private function deleteProductImage($imageName)
    {
        if (Storage::exists("products/{$imageName}")) {
            Storage::delete("products/{$imageName}");
        }
    }

    public function handleImageUpload($request, $currentImage = null)
    {
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Se existe uma imagem atual, exclua
            if ($currentImage) {
                $this->deleteProductImage($currentImage);
            }

            // Faça o upload da nova imagem
            $name = Str::kebab($request->name);
            $extension = $request->file('image')->extension();
            $nameFile = "{$name}.{$extension}";

            $upload = $request->image->storeAs($this->path, $nameFile);

            if (!$upload) {
                return null; // ou pode lançar uma exceção, dependendo do seu fluxo de trabalho
            }

            return $nameFile;
        }

        return $currentImage;
    }
}
