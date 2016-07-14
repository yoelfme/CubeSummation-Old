<?php
namespace CubeSummation\Support;

/**
* Class used to manage a 3-D Matrix
*/
class Matrix
{
    
    private $matrix = [];
    private $dimension = [];

    public function __construct($dimension)
    {
        $this->dimension = $dimension;
        $this->build($dimension);
    }

    private function build($dimension)
    {
        for ($x=0; $x <= $dimension; $x++) {
            for ($y=0; $y <= $dimension; $y++) {
                for ($z=0; $z <= $dimension; $z++) {
                    $this->matrix[$x][$y][$z] = 0;
                }
            }
        }
    }

    private function validatePoint($x, $y, $z)
    {
        return $this->validateAxis($x) && $this->validateAxis($y) && $this->validateAxis($z);
    }

    private function validateAxis($axis)
    {
        return (! ($axis > $this->dimension) && $axis >= 1);
    }

    public function update($x, $y, $z, $value)
    {
        if ($this->validatePoint($x, $y, $z)) {
            $this->matrix[$x][$y][$z] = $value;
            return "El punto $x, $y, $z ha sido actualizado correctamente";
        }

        return "El punto $x, $y, $z no es valido";
    }

    public function query($x1, $y1, $z1, $x2, $y2, $z2)
    {
        if ($this->validatePoint($x1, $y1, $z1) && $this->validatePoint($x2, $y2, $z2)) {
            $sum = 0;
            for ($i = $x1; $i <= $x2; $i++) {
                for ($j = $y1; $j <= $y2; $j++) {
                    for ($k = $z1; $k <= $z2; $k++) {
                        $sum += $this->matrix[$i][$j][$k];
                    }
                }
            }
            return $sum;
        }

        return 'El o los puntos que ingreso son invalidos';
    }
}
