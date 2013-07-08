<?php

class Ecard_Controller extends Base_Controller {

	public $restful = true;

	public function get_show( $key ) {
        $cardId = Ecard::getSlug( $key, true );
        $ecard = Cache::get('ecard_' . $cardId );

		return !File::get( path( 'storage' ) . "/uploads/ecards/$cardId.jpg" ) && !$ecard ? Redirect::to_action( 'home@index')->with( 'status', 'eCard not found.' ) : View::make('home.ecard')
			->with( 'ecard', $ecard )
			->with( 'title', 'Share eCard' )
			->with( 'type', 'eCard' )
			->with( 'thumb', URL::to_asset( "img/ecards/" . $ecard['thumb'] ) );
	}

	public function post_send() {
		$status = 'eCard Sent';
		$message = Config::get('application.thankyou_message');

		$input = Input::all();
		$ecard = Session::has( 'usereCard' ) ? Session::get( 'usereCard' ) : $input['usereCard'];

		$email = View::make('blocks.email_template', array('emailBody' => "<div style=\"color:#0195db;\">Hi " . $input['recepientName'] . ",</div><div style=\"height:10px;\"></div>
                    <div style=\"color:#0195db;\">" . $input['senderName'] . " just sent you an eCard.</div> <div style=\"height:10px;\"></div> <div>" . HTML::image( URL::to_asset( $ecard['img'] ), Config::get('application.site_name') ) . "</div>") );

		Bundle::start( 'mandrill' );
		$response = Mandrill::request('/messages/send', array(
		    'message' => array(
		        'html' => $email->render(),
		        'subject' => html_entity_decode( Config::get('application.site_title') ),
		        'from_name' => Config::get('application.site_name'),
		        'from_email' => Config::get('application.no_reply_email'),
		        'to' => array(array('email'=> $input['recepientEmail'], 'name' => $input['recepientName'])),
		    ),
		));

		return Redirect::to_action( 'ecard@show', array( $ecard['slug'] ) )
			->with( 'status', $status )
			->with( 'message', $message );
	}


	public function post_save() {
        $input = Input::all();

		if ( !isset($input['ecard']['img']) )
			return Response::Json( array( 'error' => 'Uploaded image not found, please re-upload' ) );

        $uploadedImgPath = str_replace('img/photos/', path( 'storage' ) . '/uploads/photos/', $input['ecard']['img']);

        Session::put( 'uploadedImgPath', $uploadedImgPath);

        $model = Ecard::start( $input['ecard']['img'] );

        $cardId = ( $model->id * 9834 );
        $slug = Ecard::getSlug( $cardId, false );
        $model->slug = $slug;

        $eCard = PHPImageWorkshop\ImageWorkshop::initFromPath( path( 'public' ) . $input['ecard']['src'] );
        $userImg = PHPImageWorkshop\ImageWorkshop::initFromPath( $uploadedImgPath );

        //$userImg->cropMaximumInPixel(0, 0, "LT");
        $userImg->resizeInPixel($input['params']['w'], $input['params']['h'], true, 0, 0);
        $userImg->cropInPixel($input['ecard']['width'], $input['ecard']['height'], $input['params']['x'], $input['params']['y'], 'LT');

        $dirPath = path( 'storage' ) . '/uploads/ecards/';
        $filename = $cardId . '.jpg';
        $createFolders = true;
        $backgroundColor = '#ffffff';
        $imageQuality = 100;

        $eCard->addLayerOnTop($userImg, $input['ecard']['left'], $input['ecard']['top'], 'LT');
        $eCard->save($dirPath, $filename, $createFolders, $backgroundColor, $imageQuality);

        $usereCard = "img/ecards/$filename";

        $eCard->resizeInPixel( 200, 200, true, 0,0, 'LT');
        $filename = "{$cardId}_thumb.jpg";
        $eCard->save($dirPath, $filename, $createFolders);
        $thumb = $filename;

        Cache::put("thumb_$cardId", $thumb, 262974);

        $ecard = array( 
            'slug' => $slug,
            'img' => $usereCard, 
            'thumb' => $thumb,
            'url' => Ecard::getBitly( Config::get('application.return_url') != '' ? Config::get('application.return_url') . $slug : URL::to_action('ecard@show', array( $slug ) ), $slug )
        );
        Cache::put("ecard_$cardId", $ecard, 262974);
        
        $model->img = $ecard['img'];
        $model->thumb = $ecard['thumb'];
        $model->touch();

        Session::put( 'usereCard', $ecard );
        
        return json_encode( $ecard );
	}

	public function post_upload() {
        $input = Input::all();
        $image = Input::file('imgUpload');

        $uploadValidator = Validator::make(Input::file(), array( 
        	'imgUpload' => 'image|max:500'
        ), array(
        	'image' => 'The file must be an image',
        	'max' => 'The image must be less than 500kb'
        ));
        $validationFailed = $uploadValidator->fails();
        if ( $validationFailed ) {
        	return Response::Json( array( 'errors' => $uploadValidator->errors ) );
        }

        $layer = PHPImageWorkshop\ImageWorkshop::initFromPath($image['tmp_name']);

        $dirPath = path( 'storage' ) . '/uploads/photos/';
        $filename = Session::instance()->session['id'] . '_' . uniqid($image['size']) . '_' . ( new DateTime() )->getTimestamp() . '.' . File::extension( $image['name'] );
        $createFolders = true;
        $backgroundColor = 'ffffff';

        $layer->save($dirPath, $filename, $createFolders, $backgroundColor);
        Session::put( 'uploadedImgPath', $dirPath . $filename );

        $uploaded = "img/photos/$filename";
        Session::put( 'uploadedImg', $uploaded );

        return Response::Json( array( 'uploaded' => $uploaded ) );
    }
}
