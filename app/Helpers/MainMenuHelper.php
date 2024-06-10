<?php

namespace App\Helpers;

use App\Models\Category;
use App\Models\Content;
use App\Models\Wards;
use Illuminate\Support\Str;
use stdClass;

class MainMenuHelper
{
    public function getMenu()
    {
        return cache()->remember('menu', 60 * 60 * 2, function() {
            //Todo: do cachce dorzucic
            $categories = Category::where('display_in_menu', 1)
                ->orderBy('priority')->get();

            $menu = [];


            foreach ($categories as $category) {
                $cKey = $category->id;
                $menu[$cKey] = [
                    'id' => $category->id,
                    'name' => $category->name,
                    'type' => $category->type,
                ];

                if ($category->type === 'link') {
                    $menu[$cKey]['url'] = $category->url;
                }


                if ($category->type === 'dropDown') {
                    $extraCategories = json_decode($category->menus);
                    if ($category->merge_categories) {
                        $menu[$cKey]['articles'] = $this->getMergedArticlesListFromFewCategories(array_merge([$category], $extraCategories));
                    } elseif (!empty($extraCategories) && count($extraCategories)) {
                        if ($category->display_articles) {
                            $menu[$cKey]['articles'] = $this->getArticlesForCategory($category);
                        }
                        $menu[$cKey]['extraMenu'] = $this->getExtraMenuForCategory($extraCategories);
                    } else {
                        $menu[$cKey]['articles'] = $this->getArticlesForCategory($category);
                    }
                }

                foreach ($category->additionalLinks as $link) {
                    $art = new stdClass;
                    $art->title = $link->title;
                    $art->id = $link->id;
                    $art->cid = 's_' . $link->id;
                    $art->url = $link->url;
                    $art->newTab = $link->open_in_new_tab;

                    $menu[$cKey]['articles'][] = $art;
                }
            }

            return $menu;
        });
    }

    private function getMergedArticlesListFromFewCategories(array $categoriesIds)
    {
        $articles = [];

        foreach(Content::whereIn('category_id', $categoriesIds)->where('display_on_menu', 1)->get() as $article) {
            $articles[] = $this->prepareArticleData($article);
        }

        return $articles;
    }

    private function getExtraMenuForCategory(mixed $extraCategories)
    {
        $articles = [];

        foreach(Content::whereIn('category_id', $extraCategories)->where('display_on_menu', 1)->get() as $article) {
            if (!isset($articles[$article->category_id])) {
                $articles[$article->category_id] = [
                    'name' => Category::where('id', $article->category_id)->pluck('name')->first(),
                    'articles' => []
                ];
            }
            $articles[$article->category_id]['articles'][] = $this->prepareArticleData($article);
        }

        return $articles;
    }

    private function getArticlesForCategory(mixed $category): array
    {
        $articles = [];

        foreach(Content::where('category_id', $category->id)->where('display_on_menu', 1)->get() as $article) {
            $articles[] = $this->prepareArticleData($article);
        }

        foreach (Wards::where('category_id', $category->id)->get() as $ward) {
            $articles[] = $this->prepareWardData($ward);

        }

        return $articles;
    }

    private function prepareArticleData(mixed $article): stdClass
    {
        $art = new stdClass;
        $art->title = $article->title;
        $art->id = $article->id;
        $art->cid = 'c_' . $article->id;
        $art->slug = Str::slug($article->title);
        $art->url = route('main.articles_by_id', ['slug' => $art->slug, $art->id]);
        $art->newTab = false;
        return $art;
    }

    private function prepareWardData(mixed $ward): stdClass
    {
        $art = new stdClass;
        $art->title = $ward->title;
        $art->id =  $ward->id;
        $art->cid = 'w_' . $ward->id;
        $art->slug = Str::slug($ward->title);
        $art->url = route('main.ward_by_id', [$art->slug, $art->id]);
        $art->newTab = false;

        return $art;
    }
}
