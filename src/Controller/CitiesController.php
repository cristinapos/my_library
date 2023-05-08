<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Cities Controller
 *
 * @method \App\Model\Entity\City[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CitiesController extends AppController
{
    /**
     * Funtion to get all cities depending on the parameter county
     *
     * @param string $countyName
     * @return \Cake\Http\Response|null|void
     */
    public function getCities(string $countyName)
    {
        $this->autoRender = false;
        $this->Counties = $this->fetchTable('Counties');
        $county = $this->Counties->find()
            ->where(['name' => $countyName])
            ->select(['id', 'name'])
            ->first();

        $conditions = ['Counties.name' => $county->name];

        $cities = $this->Cities->find()
            ->join([
                'table' => 'counties',
                'alias' => 'Counties',
                'type' => 'INNER',
                'conditions' => ['Cities.county_id = Counties.id']
            ])
            ->order(['Cities.name' => 'ASC'])
            ->select(['Cities.id', 'Cities.name', 'Cities.county_id',])
            ->where($conditions)
            ->group(['Cities.name'])
            ->toArray();

        if (empty($cities)) {
            return;
        }

        $response = $this->getResponse()->withStringBody(json_encode($cities));

        return $response;
    }

}
