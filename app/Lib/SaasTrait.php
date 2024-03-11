<?php
namespace App\Lib;

use Aws\CloudFront\CloudFrontClient;

trait SaasTrait{

    public function getS3Client(){


        $credentials = new \Aws\Credentials\Credentials(env('AWS_ACCESS_KEY_ID'), env('AWS_SECRET_ACCESS_KEY'));

        $s3Client = new \Aws\S3\S3Client([
            'version' => '2006-03-01',
            'region'  => env('AWS_DEFAULT_REGION'),
            'credentials'=> $credentials
        ]);

        //check if user has bucket, create if not

        return $s3Client;
    }

    public function getCloudFrontClient(){

        $client = new CloudFrontClient([
            'version' => '2014-11-06',
            'region'  => env('AWS_DEFAULT_REGION')
        ]);

        return $client;
    }


    public function getS3BucketName(){

        return env('AWS_BUCKET');
    }

}
