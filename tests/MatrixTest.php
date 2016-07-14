<?php

use CubeSummation\Support\Matrix;

class MatrixTest extends TestCase
{

    public function testCreateMatrix()
    {
        $matrix = new Matrix(3);

        $this->assertInstanceOf(Matrix::class, $matrix);
    }

    public function testUpdateValidPoint()
    {
        $matrix = new Matrix(3);

        list($x, $y, $z, $value) = [1, 1, 1, 5];

        $response = $matrix->update($x, $y, $z, $value);

        $this->assertEquals($response, "El punto $x, $y, $z ha sido actualizado correctamente");
    }

    public function testUpdateInvalidPoint()
    {
        $matrix = new Matrix(3);

        list($x, $y, $z, $value) = [4, 4, 4, 5];

        $response = $matrix->update($x, $y, $z, $value);

        $this->assertEquals($response, "El punto $x, $y, $z no es valido");
    }

    public function testQueryValidPoints()
    {
        $matrix = new Matrix(3);
        list($x1, $y1, $z1, $x2, $y2, $z2, $value1, $value2) = [1, 1, 1, 3, 3, 3, 5, 8];

        $matrix->update($x1, $y1, $z1, $value1);
        $matrix->update($x2, $y2, $z2, $value2);

        $response = $matrix->query($x1, $y1, $z1, $x2, $y2, $z2);

        $this->assertEquals($response, $value1 + $value2);
    }

    public function testQueryInvalidPoints()
    {
        $matrix = new Matrix(3);
        list($x1, $y1, $z1, $x2, $y2, $z2, $value1, $value2) = [1, 1, 1, 4, 4, 4, 5, 8];

        $response = $matrix->query($x1, $y1, $z1, $x2, $y2, $z2);

        $this->assertEquals($response, 'El o los puntos que ingreso son invalidos');
    }
}
