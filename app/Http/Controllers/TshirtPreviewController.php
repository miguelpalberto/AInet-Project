<?php

namespace App\Http\Controllers;

use Intervention\Image\Facades\Image;
use App\Models\Color;
use App\Models\TshirtImage;
use Illuminate\Http\Request;

class TshirtPreviewController extends Controller
{
    public function createPreview(Request $request)
    {
        // dd('Controller called');
        $colorCode = $request->input('color');
        $image_url = $request->input('image_url');
        // dd($colorCode, $image_url);

        // Caminhos para as imagens
        $tshirtEmptyPath = public_path('storage/tshirt_base/'.$colorCode.'');
        $tshirtDesignPath = public_path('storage/tshirt_images/'.$image_url.'');
        $previewPath = public_path('tshirt_preview.png');
        
        // $tshirtEmptyPath = public_path('storage/tshirt_base/1e1e21.jpg');
        // $tshirtDesignPath = public_path('storage/tshirt_images/1_6477be5abb99f.png');
        // $previewPath = public_path('storage/tshirt_preview.png');
        // dd($tshirtEmptyPath, $tshirtDesignPath);


        // Carregar imagens
        $tshirtEmpty = Image::make($tshirtEmptyPath);
        $tshirtDesign = Image::make($tshirtDesignPath);

        // Redimensionar
        $tshirtEmpty->resize(400, 400);
        $tshirtDesign->resize(200, 200);

        // Criar a nova iamgem
        $preview = Image::canvas($tshirtEmpty->width(), $tshirtEmpty->height());

        // Imagem da t-shirt vazia
        $preview->insert($tshirtEmpty, 'top-left', 0, 0);

        // Meter imagem do desenho
        $positionX = ($preview->width() - $tshirtDesign->width()) / 2;
        $positionY = ($preview->height() - $tshirtDesign->height()) / 2;
        $preview->insert($tshirtDesign, 'top-left', $positionX, $positionY);

        // gravar
        $preview->save($previewPath);
        // return response()->download($previewPath);

        // Mostrar
        $imageData = $preview->encode('png');
        return response($imageData)
            ->header('Content-Type', 'image/png')
            ->header('Content-Disposition', 'inline');
        }

}
