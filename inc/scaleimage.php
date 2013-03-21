<?php
function ScaleImage($srcwidth, $srcheight, $targetwidth, $targetheight, $fLetterBox) {

    $result = array('width'=> 0, 'height' => 0, 'fscaleToTargetWidth'=> true,'targetleft'=>0, 'targettop'=>0);

    if (($srcwidth <= 0) || ($srcheight <= 0) || ($targetwidth <= 0) || ($targetheight <= 0)) {
        return $result;
    }

    // $scale to the $target width
    $scaleX1 = $targetwidth;
    $scaleY1 = ($srcheight * $targetwidth) / $srcwidth;

    // $scale to the $target height
    $scaleX2 = ($srcwidth * $targetheight) / $srcheight;
    $scaleY2 = $targetheight;

    // now figure out which one we should use
    $fscaleOnWidth = ($scaleX2 > $targetwidth);
    if ($fscaleOnWidth) {
        $fscaleOnWidth = $fLetterBox;
    }
    else {
       $fscaleOnWidth = !$fLetterBox;
    }

    if ($fscaleOnWidth) {
        $result['width'] = floor($scaleX1);
        $result['height'] = floor($scaleY1);
        $result['fscaleToTargetWidth'] = true;
    }
    else {
        $result['width'] = floor($scaleX2);
        $result['height'] = floor($scaleY2);
        $result['fscaleToTargetWidth'] = false;
    }
    $result['targetleft'] = floor(($targetwidth - $result['width']) / 2);
    $result['targettop'] = floor(($targetheight - $result['height']) / 2);

    return $result;
}
?>