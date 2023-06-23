<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class TshirtPreviewController extends Controller
{
    public function createPreview()
    {
        // Caminhos para as imagens
        $tshirtEmptyPath = public_path('storage/tshirt_base/00a2f2.jpg');
        $tshirtDesignPath = public_path('storage/tshirt_images/1_6477be5abb99f.png');
        $previewPath = public_path('tshirt_preview.png');

        // Carregar imagens
        $tshirtEmpty = Image::make($tshirtEmptyPath);
        $tshirtDesign = Image::make($tshirtDesignPath);

        // Redimensionar
        $tshirtEmpty->resize(400, 400);
        $tshirtDesign->resize(200, 200);

        // Criar a nova iamgem
        $preview = Image::canvas($tshirtEmpty->width(), $tshirtEmpty->height());

        // Copiar imagem da t-shirt vazia
        $preview->insert($tshirtEmpty, 'top-left', 0, 0);

        // Meter imagem do desenho
        $positionX = ($preview->width() - $tshirtDesign->width()) / 2;
        $positionY = ($preview->height() - $tshirtDesign->height()) / 2;
        $preview->insert($tshirtDesign, 'top-left', $positionX, $positionY);

        // gravar
        $preview->save($previewPath);

        return response()->download($previewPath);
    }
}
