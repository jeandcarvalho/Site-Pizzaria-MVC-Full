<?php

namespace App\Controller\Pages;

USE \App\Utils\View;


class Page{

    public static function getPagination($request,$obPagination){
        $pages = $obPagination->getPages();

        if(count($pages) <=1)return '';

        $links = ''; //link

        $url = $request->getRouter()->getcurrentUrl(); //URL atual

        $queryParams = $request->getQueryParams(); //get atual
        
        foreach($pages as $page){
            $queryParams['page'] = $page['page'];

            $link = $url.'?'.http_build_query($queryParams); //concatena o link corretamente
            
            $links .= View::render('pages/pagination/link',[
                'page' => $page['page'],
                'link' => $link,
                'active' => $page['current'] ? 'active' : ''
            ]);
        }

        return View::render('pages/pagination/box',[ //renderiza o box da paginação
            'links' => $links
        ]); 
  
    }

    private static function getFooter(){ //retorna a footer das páginas
        return View::render('pages/footer');
    }

    private static function getHeader(){ //retorna a header das páginas
        return View::render('pages/header');
    }

      
    public static function getPage($title,$content){ //retorna o conteúdo da página
        return View::render('pages/page',[
            'title' => $title,
            'footer' => self::getFooter(),
            'header' => self::getHeader(),
            'content' => $content
        ]);
    }

}
