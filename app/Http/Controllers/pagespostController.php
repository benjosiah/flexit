<?php

namespace App\Http\Controllers;
use App\Page_post;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Guzzle\Http\Exception\ClientErrorResponseException;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
class pagespostController extends Controller
{
    public function postpagepost(Request $request)
    {
        $this->validate($request,[
            'text'=>'required'
        ]);

        $page = new Page_post();
        $page->post = $request['text'];
        $page->page_id= $request['page_id'];
        $image=$request->file('image');
        $ext=$request->file('image')->extension();
        $image_name='IMG'. uniqid('_',true).'.'.$ext;
        if ($image) {
            $store=Storage::disk('local')->put($image_name, File::get($image));
            if ($store) {
                $page->image= $image_name;
                $page->save();
                return redirect()->back();
            }
        }
        
    }
    public function Getfile($image_name)
    {
        $image=Storage::disk('local')->get($image_name);
        return new Response($image, 200);     
    }
    public function getpost($post_id)
    {
        $post=Page_post::where('id',$post_id)->first();
        return view('post',['post'=>$post]);
    }

    public function getKey($seckey){
        $hashedkey = md5($seckey);
        $hashedkeylast12 = substr($hashedkey, -12);
      
        $seckeyadjusted = str_replace("FLWSECK-", "", $seckey);
        $seckeyadjustedfirst12 = substr($seckeyadjusted, 0, 12);
      
        $encryptionkey = $seckeyadjustedfirst12.$hashedkeylast12;
        return $encryptionkey;
      
    }
    
    public function encrypt3Des($data, $key)
    {
        $encData = openssl_encrypt($data, 'DES-EDE3', $key, OPENSSL_RAW_DATA);
        return base64_encode($encData);
    }
    
    public function card(Request $request)
    {
        $pubkey=env('FLWPUBK');




        $details=[
            'PBFPubKey'=>$pubkey,
            'cardno'=> $request['card'],
            'currency' => 'NGN',
    '       country' => 'NG',
            'cvv'=> $request['cvv'],
            'expirymonth'=> $request['month'],
            'expiryyear'=> $request['year'],
            'amount'=> 10,
            'email'=> $request['email'],
            'suggested_auth' => 'PIN',
            'pin' => '7585',
            "BIN"=>"539941",
            "redirect_url"=>"https://rave-webhook.herokuapp.com/receivepayment",
            'txRef' => 'MC-'.uniqid('',true)

        ];

        $SecKey = env('FLWSECK');
    
        $key = $this->getKey($SecKey); 
    
        $dataReq = json_encode($details);
    
        $post_enc = $this->encrypt3Des( $dataReq, $key );
        
         $body= [
            'PBFPubKey'=>$pubkey,
            'client' => $post_enc,
            'alg' => '3DES-24',
        ];
        
        
        $client = new Client([
            'headers'=>[
                'Content-Type'=>'application/json'
            ]
        ]);
        try {
            $res = $client->request('POST', 'https://api.ravepay.co/flwv3-pug/getpaidx/api/charge',
            ['verify' => false,
            'body'=> json_encode($body)]);
            $data= json_decode($res->getBody());
            $flwRef=$data->data->flwRef;
            return view('confirm', ['PBFPubKey'=>$details['PBFPubKey'], 'flwRef'=>$flwRef]);
        } catch (RequestException $e) {
            $response =json_decode($e->getResponse()->getBody(true));
            return redirect()->back()->with(['message'=>$response->message]);
        }
        
    }

     public function postotp(Request $request)
     {
        $pubkey=env('FLWPUBK');;
        $flwRef= $request['txRef'];
        $body= [

            'PBFPubKey'=>$pubkey,
            'transaction_reference' => $request['txRef'],
            'otp' => $request['otp'],
        ];
        $client = new Client([
            'headers'=>[
                'Content-Type'=>'application/json'
            ]
        ]);
        try {
            $res = $client->request('POST', 'https://api.ravepay.co/flwv3-pug/getpaidx/api/validatecharge',
            ['verify' => false,
            'body'=> json_encode($body)]);
            $data= json_decode($res->getBody());
            $responsemessage=$data->data->data->responsemessage;
            return $responsemessage;
        } catch (RequestException $e) {
            $response =json_decode($e->getResponse()->getBody(true));
            return $response->message;
        }
     }

}
