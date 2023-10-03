<?php

namespace App\Libraries;

use PDO;
use ClanCats\Hydrahon\Builder;

class Hydrahon
{
                    
	public function db($connection)
	{

        $h = new Builder('mysql', function($query, $queryString, $queryParameters) use($connection)
        {
            
            $statement = $connection->prepare($queryString);
            $statement->execute($queryParameters);

            if ($query instanceof \ClanCats\Hydrahon\Query\Sql\FetchableInterface)
            {
                return $statement->fetchAll(\PDO::FETCH_ASSOC);
            }
            elseif($query instanceof \ClanCats\Hydrahon\Query\Sql\Insert)
            {
                return $connection->lastInsertId();
            }
            // when the query is not a instance of insert or fetchable then
            // return the number os rows affected
            else 
            {
                return $statement->rowCount();
            }	
        });

        return $h;
        
	}


}


?>