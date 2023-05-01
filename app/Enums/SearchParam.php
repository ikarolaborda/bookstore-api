<?php

namespace App\Enums;

/* Aqui encontram-se todos os parâmetros pesquisáveis, caso voce necessite incluir algum novo parâmetro, utilize este enum */
enum SearchParam: string
{
    case Title = 'title';
    case Author = 'author';
    case Id = 'id';
    case ISBN = 'ISBN';
    case Email = 'email';
    case Username = 'username';
}
