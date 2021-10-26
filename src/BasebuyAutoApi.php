<?php
namespace Mutahir\Carsdbapi;


use \Carsdbapi\exceptions\EmptyResponseException;
use \Carsdbapi\exceptions\Exception;


class BasebuyAutoApi
{
    /** @var IConnector */
    private $_connector;

    const FORMAT_CSV = 'csv.en';
    const FORMAT_XML = 'xml';
    const FORMAT_JSON = 'json';
    const FORMAT_TIMESTAMP = 'timestamp.en';
    const FORMAT_STRING = 'string';

    /**
     * BasebuyAutoApi constructor.
     *
     * @param IConnector $connector
     */
    public function __construct(IConnector $connector)
    {
        $this->_connector = $connector;
    }

    /* Type */
    public function typeGetAll($format = self::FORMAT_CSV, $is_download = true)
    {
        $data = $this->get('type.getAll', $format, [], $is_download);

        return $data;
    }

    public function typeGetDateUpdate($format = self::FORMAT_TIMESTAMP)
    {
        $data = $this->get('type.getDateUpdate', $format, []);

        return $data;
    }


    /* Mark */
    public function markGetAll($id_type, $format = self::FORMAT_CSV, $is_download = true)
    {
        $data = $this->get('make.getAll', $format, [
            'id_type' => $id_type,
        ], $is_download);

        return $data;
    }

    public function markGetDateUpdate($id_type, $format = self::FORMAT_TIMESTAMP)
    {
        $data = $this->get('make.getDateUpdate', $format, [
            'id_type' => $id_type,
        ]);

        return $data;
    }


    /* Model */
    public function modelGetAll($id_type, $format = self::FORMAT_CSV, $is_download = true)
    {
        $data = $this->get('model.getAll', $format, [
            'id_type' => $id_type,
        ], $is_download);

        return $data;
    }

    public function modelGetDateUpdate($id_type, $format = self::FORMAT_TIMESTAMP)
    {
        $data = $this->get('model.getDateUpdate', $format, [
            'id_type' => $id_type,
        ]);

        return $data;
    }


    /* Generation */
    public function generationGetAll($id_type, $format = self::FORMAT_CSV, $is_download = true)
    {
        $data = $this->get('generation.getAll', $format, [
            'id_type' => $id_type,
        ], $is_download);

        return $data;
    }

    public function generationGetDateUpdate($id_type, $format = self::FORMAT_TIMESTAMP)
    {
        $data = $this->get('generation.getDateUpdate', $format, [
            'id_type' => $id_type,
        ]);

        return $data;
    }


    /* Serie */
    public function serieGetAll($id_type, $format = self::FORMAT_CSV, $is_download = true)
    {
        $data = $this->get('serie.getAll', $format, [
            'id_type' => $id_type,
        ], $is_download);

        return $data;
    }

    public function serieGetDateUpdate($id_type, $format = self::FORMAT_TIMESTAMP)
    {
        $data = $this->get('serie.getDateUpdate', $format, [
            'id_type' => $id_type,
        ]);

        return $data;
    }


    /* Trim */
    public function trimGetAll($id_type, $format = self::FORMAT_CSV, $is_download = true)
    {
        $data = $this->get('trim.getAll', $format, [
            'id_type' => $id_type,
        ], $is_download);

        return $data;
    }

    public function trimGetDateUpdate($id_type, $format = self::FORMAT_TIMESTAMP)
    {
        $data = $this->get('trim.getDateUpdate', $format, [
            'id_type' => $id_type,
        ]);

        return $data;
    }





     /* Specifications */
     public function specificationGetAll($id_type, $format = self::FORMAT_CSV, $is_download = true)
     {
         $data = $this->get('specification.getAll', $format, [
             'id_type' => $id_type,
         ], $is_download);
 
         return $data;
     }
 
     public function specificationGetDateUpdate($id_type, $format = self::FORMAT_TIMESTAMP)
     {
         $data = $this->get('specification.getDateUpdate', $format, [
             'id_type' => $id_type,
         ]);
 
         return $data;
     }
 
 
     /* specification Values */
     public function specificationValueGetAll($id_type, $format = self::FORMAT_CSV, $is_download = true)
     {
         $data = $this->get('specificationValue.getAll', $format, [
             'id_type' => $id_type,
         ], $is_download);
 
         return $data;
     }
 
     public function specificationValueGetDateUpdate($id_type, $format = self::FORMAT_TIMESTAMP)
     {
         $data = $this->get('specificationValue.getDateUpdate', $format, [
             'id_type' => $id_type,
         ]);
 
         return $data;
     }
 


    /* Modification */
    public function modificationGetAll($id_type, $format = self::FORMAT_CSV, $is_download = true)
    {
        $data = $this->get('modification.getAll', $format, [
            'id_type' => $id_type,
        ], $is_download);

        return $data;
    }

    public function modificationGetDateUpdate($id_type, $format = self::FORMAT_TIMESTAMP)
    {
        $data = $this->get('modification.getDateUpdate', $format, [
            'id_type' => $id_type,
        ]);

        return $data;
    }


    /* Characteristic */
    public function characteristicGetAll($id_type, $format = self::FORMAT_CSV, $is_download = true)
    {
        $data = $this->get('characteristic.getAll', $format, [
            'id_type' => $id_type,
        ], $is_download);

        return $data;
    }

    public function characteristicGetDateUpdate($id_type, $format = self::FORMAT_TIMESTAMP)
    {
        $data = $this->get('characteristic.getDateUpdate', $format, [
            'id_type' => $id_type,
        ]);

        return $data;
    }


    /* Characteristic */
    public function characteristicValueGetAll($id_type, $format = self::FORMAT_CSV, $is_download = true)
    {
        $data = $this->get('characteristicValue.getAll', $format, [
            'id_type' => $id_type,
        ], $is_download);

        return $data;
    }

    public function characteristicValueGetDateUpdate($id_type, $format = self::FORMAT_TIMESTAMP)
    {
        $data = $this->get('characteristicValue.getDateUpdate', $format, [
            'id_type' => $id_type,
        ]);

        return $data;
    }


    /**
     * @param string $method
     * @param string $format
     * @param array $data
     * @param boolean $is_download
     *
     * @return array
     *
     * @throws Exception
     */
    private function get($method, $format, array $data, $is_download = false)
    {
        $requestResult = null;
        if ($is_download) {
            $downloadedFilePath = $this->_connector->download($method, $format, $data);
            $requestResult = $downloadedFilePath;
        } else {
            $fileData = $this->_connector->get($method, $format, $data);
            $requestResult = $fileData;
        }

        //$data = $parser->parse($requestResult);
        /*
                if(!isset($data['status'])) {
                    throw new EmptyResponseException();
                }

                if($data['status'] === 'fail') {

                    // Specific error codes may be processed with special exception for better error handling

                    throw new Exception(
                        isset($data['error']['description']) ? $data['error']['description'] : null,
                        isset($data['error']['code']) ? $data['error']['code'] : null
                    );
                }

                if($data['status'] !== 'ok') {
                    throw new Exception('Unknown response status');
                }
        */
        return $requestResult;
    }
}