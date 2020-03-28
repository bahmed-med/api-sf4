<?php


namespace App\SearchRepository;

use Elastica\Query;
use Elastica\Query\BoolQuery;
use FOS\ElasticaBundle\Repository;
//use Elastica\Query\Range;
use Elastica\Aggregation\Range;



class ProductRepository extends Repository
{

    public function search($search = null, $limit = 10)
    {
        $query = new Query();

        $boolQuery = new BoolQuery();

        if (!\is_null($search)) {
            $fieldQuery = new Query\MatchPhrasePrefix();
            $fieldQuery->setField('name', $search);

            $boolQuery->addMust($fieldQuery);
        }
       
        if (!\is_null($search)) {
            $fieldQuery = new Query\MatchPhrasePrefix();
            $fieldQuery->setField('description', $search);

            $boolQuery->addMust($fieldQuery);
        }

        
        /*
        $oFilterRange = new Range('ag');
        $oFilterRange->addAggregation('ag');
        $oFilterRange->setField('price');
        $oFilterRange->addRange(20, 100, null);
        $boolQuery->addMust( $oFilterRange);
        
         */
        //$boolQuery->addShould()
        /*
        $elasticaFilterRange = new Elastica\Query\Range;
        $elasticaFilterRange->addField('price', array("from" => 12, 'to' => 100));
        $boolQuery = new Elastica\Query\Filtered($query, $elasticaFilterRange);
        */

        $query->setQuery($boolQuery);
        $query->setSize($limit);

        return $this->find($query);
    }

    /**
     * @param null $search
     * @param $limit
     * @return array
     *
     */

    public function searchProduct($search , $limit)
    {
        $query = new BoolQuery;

        $query->addShould((new Query\Match())
            //->setFieldQuery('name', $search)
            ->setField('name', $search)
          //  ->setFieldBoost('name', 5)
        );

        /*

        $query->addShould((new Query\Match())
            ->setFieldQuery('description', $search)
            ->setFieldBoost('description', 2)
        );
        */

       // $query->setSize($limit);
        $query->setQuery($query);

        return $this->find($query);
    }

}