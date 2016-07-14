<?php
namespace CubeSummation\Support;

/**
* Class used to manage payload of request
*/
class Operator
{

    private $maxNumberTests = 50;
    private $maxDimension = 100;
    private $maxNumberOperations = 1000;
    private $commands = '';

    public function __construct($commands)
    {
        $this->commands = $commands;
    }

    public function process()
    {
        // Split commands by salt of line and trim spaces
        $commands = array_map(function ($value) {
            return trim($value);
        }, explode(PHP_EOL, $this->commands));

        // Remove blank lines
        $commands = array_filter($commands, function ($value) {
            return strlen($value) > 0;
        });

        // Reorder keys if filter
        $commands = array_values($commands);

        $results = [];
        $index = 1;

        try {
            $numberTests = intval($commands[0]);
            $actualTest = 0;
            // Validate number of tests
            if ($this->validateNumberTests($numberTests)) {
                for ($i=0; $i < $numberTests; $i++) {
                    $actualTest = $i + 1;
                    // Get dimension of matrix and number of operations
                    list($dimension, $operations) = explode(' ', $commands[$index]);

                    $validDimension = $this->validateDimension($dimension);
                    $validOperations = $this->validateNumberOperations($operations);

                    // Validate dimension and operations
                    if ($validDimension && $validOperations) {
                        // Build the matrix for test
                        $matrix = new Matrix($dimension);
                        
                        // Change of line
                        $index++;

                        // Execute all tests
                        for ($j=0; $j < $operations; $j++) {
                            if (array_key_exists($index, $commands)) {
                                $results[] =$this->executeCommand($matrix, $commands[$index]);
                                $index++;
                            }
                        }
                    } else {
                        if (! $validDimension) {
                            $results[] = "La dimension para la matriz del test $actualTest  es invalida";
                        }

                        if (! $validOperations) {
                            $results[] = "El numero de operaciones para el test $actualTest es invalido";
                        }
                    }
                }
            } else {
                $results[] = 'El numero de tests a ejecutar es invalido';
            }
        } catch (Exception $e) {
            $results[] = 'Ha ocurrido un error mientras se procesaba la peticion. \n' . $e->getMessage();
        }
        
        return $results;
    }

    private function isValidCommand($command)
    {
        return starts_with($command, 'UPDATE') || starts_with($command, 'QUERY');
    }

    private function executeCommand($matrix, $command)
    {
        $items = explode(' ', $command);

        if (count($items) > 0) {
            $typeCommand = $items[0];

            switch ($typeCommand) {
                case 'UPDATE':
                    return $this->executeUpdate($matrix, array_slice($items, 1));
                    break;
                case 'QUERY':
                    return $this->executeQuery($matrix, array_slice($items, 1));
                    break;
                default:
                    return "El comando ${command} no existe";
                    break;
            }
        }
    }



    private function validateNumberTests($numberTests)
    {
        return ($numberTests <= $this->maxNumberTests && $numberTests >= 1);
    }

    private function validateDimension($dimenxion)
    {
        return ($dimenxion <= $this->maxDimension && $dimenxion >= 1);
    }

    private function validateNumberOperations($numberOperations)
    {
        return ($numberOperations <= $this->maxNumberOperations && $numberOperations >= 1);
    }

    private function executeUpdate($matrix, $args)
    {
        $parameters = 4;
        if (count($args) !== $parameters) {
            return "Para ejecutar el comando UPDATE necesita $parameters parametros";
        }

        list($x, $y, $z, $value) = $args;

        return $matrix->update($x, $y, $z, $value);
    }

    private function executeQuery($matrix, $args)
    {
        $parameters = 6;
        if (count($args) !== $parameters) {
            return "Para ejecutar el comando QUERY necesita $parameters parametros";
        }

        list($x1, $y1, $z1, $x2, $y2, $z2) = $args;

        $total = $matrix->query($x1, $y1, $z1, $x2, $y2, $z2);

        return "La suma de los puntos $x1,$y1,$z1 y $x2,$y2,$z2 es igual a: $total";
    }
}
