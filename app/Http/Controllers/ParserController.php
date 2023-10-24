<?php

namespace App\Http\Controllers;

use DOMXPath;
use DOMDocument;
use Goutte\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class ParserController extends Controller
{

    private $patterns = [];
    private $properties = [];

    public function addPattern($key, $pattern)
    {
        $this->patterns[$key] = $pattern;
        return $this;
    }


    public function setProperties(Request $request)
    {
        $first = $request->input('first');
        $second = $request->input('second');
        $third = $request->input('third');

        $properties = session('properties');

        if (empty($properties)) {
            $properties = [
                'first' => $first,
                'second' => $second,
                'third'  => $third
            ];
            session()->put('properties', $properties);
        }

        $data = session('properties');
        return $data;
    }


    public function getProperties(Request $request)
    {

        $properties = $this->setProperties($request);
        return $properties;
    }


    public function clean()
    {
        session()->forget('properties');
        $data = session('properties');
        return view('parse-form', compact('data'));
    }



    public function cleanCookie()
    {
        return response('Успешно удалено')->withCookie(Cookie::forget('cookie_name'));
    }


    public function getInfo(Request $request)
    {

        $properties = $this->getProperties($request);

        $wordToFind1 = $properties['first'] ?? '';
        $wordToFind2 = $properties['second'] ?? '';
        $wordToFind3 = $properties['third'] ?? '';

        $first = '/.*?class=["\']([^"\']*?' . preg_quote($wordToFind1, '/') . '[^"\']*?)["\'].*?/';
        $second = '/.*?class=["\']([^"\']*?' . preg_quote($wordToFind2, '/') . '[^"\']*?)["\'].*?/';
        $third = '/.*?class=["\']([^"\']*?' . preg_quote($wordToFind3, '/') . '[^"\']*?)["\'].*?/';

        $patterns = [
            $wordToFind1 => $first,
            $wordToFind2 => $second,
            $wordToFind3 => $third,

        ];

        return $patterns;
    }



    public function parseContacts(Request $request)
    {
        $urls = explode("\n", $request->input('urls'));

        $data = [];
        $patterns = $this->getInfo($request);
        $keys = array_keys($patterns);

        $results = [];

        foreach ($urls as $url) {
            $url = trim($url);
            if (!empty($url)) {
                $client = new Client();
                $crawler = $client->request('GET', $url);

                foreach ($patterns as $key => $pattern) {

                    $content = $crawler->html();
                    preg_match($pattern, $content, $matches);
                    if (!empty($matches)) {

                        $data[$keys[0]] = [
                            isset($matches[0]) ? $matches[0] : null,
                        ];
                        $data[$keys[1]] = [
                            isset($matches[1]) ? $matches[1] : null,
                        ];
                        $data[$keys[2]] = [
                            isset($matches[2]) ? $matches[2] : null,
                        ];
                    }
                }

                $keys = array_keys($patterns);

                foreach ($patterns as $key => $value) {
                    $result[$keys[0]] = isset($data[$keys[0]][1]) ? $data[$keys[0]][1] : null;
                    $result[$keys[1]] = isset($data[$keys[1]][2]) ? $data[$keys[1]][2] : null;
                    $result[$keys[2]] = isset($data[$keys[2]][3]) ? $data[$keys[2]][3] : null;
                }

                $first = [];
                if ($keys[0]) {
                    $first = $crawler->filterXPath('//div[contains(@class, "' . $keys[0] . '")]')->each(function ($node) {
                        return $node->text();
                    });
                }
                $second = [];
                if ($keys[1]) {
                    $second = $crawler->filterXPath('//div[contains(@class, "' . $keys[1] . '")]')->each(function ($node) {
                        return $node->text();
                    });
                }
                $third = [];
                if ($keys[2]) {
                    $third = $crawler->filterXPath('//div[contains(@class, "' . $keys[2] . '")]')->each(function ($node) {
                        return $node->text();
                    });
                }

                $result = [
                    'url' => $url,
                    $keys[0] => $first,
                    $keys[1] => $second,
                    $keys[2] => $third,
                ];

                $results[] = $result;
            }
        }
        dd($results);
        // return response()->json($results);
    }


    public function showForm()
    {
        return view('parse-form');
    }
    public function showCheck()
    {
        return view('set-property');
    }
}
