<?php
/**
 * Created by PhpStorm.
 * User: USER PC
 * Date: 6/12/2017
 * Time: 1:15 PM
 */

namespace App\V2\Form;


use App\V2\Model\CertificateLessonTable;
use App\V2\Model\CertificateTable;
use App\V2\Model\SessionLessonTable;

class EditCertificateForm extends CertificateForm {

    public function __construct($name = null,$serviceLocator)
    {
        parent::__construct($name,$serviceLocator);
        $this->createCheckbox('any_session','search-all-sessions-text',1);
        $this->createHidden('html');
        $this->get('html')->setAttribute('id','html');
    }

}
