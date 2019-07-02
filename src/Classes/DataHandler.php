<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Classes;

use Guzzle\Http\Client;

abstract class DataHandler
{
    private $api_url = "http://api.thejournal.ie/v3/sample/";
    private $username = "sample";
    private $password = "eferw5wr335£65";
    private $tag = "";
    private $id = 0;

    private function _processJSON( $articles ): array
    {
        $return_data = array();

        foreach($articles as $article):
            $id = (@$article['id'])?$article['id']:"";
            $title = (@$article['title'])?$article['title']:"";
            $excerpt = (@$article['excerpt'])?$article['excerpt']:"";
            $type = (@$article['type'])?$article['type']:"";
            $content = (@$article['content'])?$article['content']:"";
            $tags = (@$article['tags'])?$article['tags']:array();

            foreach ($tags as $i => $tag) {
                $tags[$i] = $tag['slug'];
            }

            $image = (@$article['images'])?$article['images']['thumbnail']['image']:"";

            if($type === "post"):
                $return_data[] = array(
                    "id"=> $id,
                    "title" => $title,
                    "excerpt" => $excerpt,
                    "image" => $image,
                    "comtent" => $content,
                    "tags" => $tags
                );
            endif;
        endforeach;

        return $return_data;
    }

    public function setTag($tag): string
    {
        return $this->tag = $tag;
    }

    public function setArticle($id): string
    {
        return $this->id = $id;
    }

    public function fetchAPI(): array
    {
        try{
            $curl_url = ($this->tag) ? $this->api_url . "tag/" . $this->tag : $this->api_url . "thejournal/";

            $guzzle = new Client();
            $response = $guzzle->get($curl_url, array(), array(
                "auth" => array($this->username, $this->password, 'Basic')
            ))->send();

            if($response->isSuccessful()):
                $json_data = $response->json();

                if(@$json_data['response']['articles'] && count($json_data['response']['articles']) > 0):
                    $json = $this->_processJSON($json_data['response']['articles']);

                    if ($this->id) {
                        foreach ($json as $article) {
                            if ($article['id'] == $this->id) {
                                return $article;
                            }
                        }
                    }

                    return $json;
                else:
                        return array();
                endif;
            endif;
        }catch(Exception $e){}

        return array();
    }

    public function fetchFile(): array
    {
        $file_location = DEMO_RESPONSES . (($this->tag) ? "/".$this->tag.".json" : "/thejournal.json");
        try{
            if( file_exists($file_location) ):
                $json_data = file_get_contents($file_location);

                $json = $this->_processJSON(json_decode($json_data, true));

                if ($this->id) {
                    foreach ($json as $article) {
                        if ($article['id'] == $this->id) {
                            return $article;
                        }
                    }
                }

                return $json;
            else:
                return array();
            endif;
        }catch(Exception $e){}

        return array();
    }
}