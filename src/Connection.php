<?php

namespace Titeca\SqlAnywhere;

use Illuminate\Database\Connection as IlluminateConnection;
use Titeca\SqlAnywhere\Grammar\QueryGrammar;
use Titeca\SqlAnywhere\Grammar\SchemaGrammar;

class Connection extends IlluminateConnection
{
	/**
     * Get the default query grammar instance.
     *
     * @return \Illuminate\Database\Query\Grammars\Grammar
     */
    protected function getDefaultQueryGrammar()
    {
        return new QueryGrammar;
    }

    /**
     * Get the default schema grammar instance.
     *
     * @return \Illuminate\Database\Schema\Grammars\Grammar
     */
    protected function getDefaultSchemaGrammar()
    {
        return new SchemaGrammar;
    }
}