<?php

use CubeSummation\Support\Operator;

class OperatorTest extends TestCase
{

    public function testProcessValidCommands()
    {
        $commands = "1 \n
                    4 5 \n
                    UPDATE 2 2 2 4 \n
                    QUERY 1 1 1 3 3 3 \n
                    UPDATE 1 1 1 23 \n
                    QUERY 2 2 2 4 4 4 \n
                    QUERY 1 1 1 3 3 3 \n";

        $operator = new Operator($commands);
        $results = $operator->process();
        
        $this->assertEquals($results, [
            'El punto 2, 2, 2 ha sido actualizado correctamente',
            'La suma de los puntos 1,1,1 y 3,3,3 es igual a: 4',
            'El punto 1, 1, 1 ha sido actualizado correctamente',
            'La suma de los puntos 2,2,2 y 4,4,4 es igual a: 4',
            'La suma de los puntos 1,1,1 y 3,3,3 es igual a: 27'
        ]);
    }

    public function testProcessInvalidCommands()
    {
        $commands = "1 \n
                    4 5 \n
                    UPDATE 2 2 \n
                    QUERY 1 1 1 3 3 3 \n
                    UPDATE 1 1 1 23 \n
                    QUERY 2 2 2 4 4 4 \n
                    QUERY 1 1 1 3 3 3 \n";

        $operator = new Operator($commands);
        $results = $operator->process();
        
        $this->assertEquals($results, [
            'Para ejecutar el comando UPDATE necesita 4 parametros',
            'La suma de los puntos 1,1,1 y 3,3,3 es igual a: 0',
            'El punto 1, 1, 1 ha sido actualizado correctamente',
            'La suma de los puntos 2,2,2 y 4,4,4 es igual a: 0',
            'La suma de los puntos 1,1,1 y 3,3,3 es igual a: 23'
        ]);
    }

    public function testProcessInvalidNumberCommands()
    {
        $commands = "100 \n
                    4 5 \n
                    UPDATE 2 2 2 4 \n
                    QUERY 1 1 1 3 3 3 \n
                    UPDATE 1 1 1 23 \n
                    QUERY 2 2 2 4 4 4 \n
                    QUERY 1 1 1 3 3 3 \n";

        $operator = new Operator($commands);
        $results = $operator->process();
        
        $this->assertEquals($results, [
            'El numero de tests a ejecutar es invalido'
        ]);
    }

    public function testProcessInvalidDimension()
    {
        $commands = "1 \n
                    150 5 \n
                    UPDATE 2 2 2 4 \n
                    QUERY 1 1 1 3 3 3 \n
                    UPDATE 1 1 1 23 \n
                    QUERY 2 2 2 4 4 4 \n
                    QUERY 1 1 1 3 3 3 \n";

        $operator = new Operator($commands);
        $results = $operator->process();
        
        $this->assertEquals($results, [
            'La dimension para la matriz del test 1  es invalida'
        ]);
    }
    
    public function testProcessInvalidNumberOperations()
    {
        $commands = "1 \n
                    5 1500 \n
                    UPDATE 2 2 2 4 \n
                    QUERY 1 1 1 3 3 3 \n
                    UPDATE 1 1 1 23 \n
                    QUERY 2 2 2 4 4 4 \n
                    QUERY 1 1 1 3 3 3 \n";

        $operator = new Operator($commands);
        $results = $operator->process();
        
        $this->assertEquals($results, [
            'El numero de operaciones para el test 1 es invalido'
        ]);
    }
}
