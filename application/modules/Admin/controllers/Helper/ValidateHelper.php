<?php
namespace modules\Admin\controllers\Helper;

use library\Core\Tools;
use library\Base\Validator;
use Illuminate\Database\Capsule\Manager as Capsule;
use Exception;
/**
 *
 */
class ValidateHelper{
    /**
     * [validate description]
     * @return [type] [description]
     */
    public function loginValidate( array $response )
    {
      try {
          //$this->_validateDrive( $response,['account' => '用户名' ,'password' => '密码']);

          $valdite  = new Validator( $response );
          $valdite->rule('required', $key);
          $valdite->labels($labels);
          if ($valdite->validate()) return true;
          // 返回失败原因
          foreach ($valdite->errors() as $errors_key => $errors) {
              foreach ($errors as $_error_info) {
                  throw new Exception($_error_info, 15000);
              }
          }
      } catch (Exception $e) {
          return  json_encode(['code' => $e->getCode() ,'message' => $e-> getMessage()]);
      }
    }

    /**
     * [_validateDrive 验证器]
     * @param  array  $info   [description]
     * @param  [type] $fileds [description]
     * @return [type]         [description]
     */
    protected function _validateDrive( array $v_info, $labels =[] ,$field= [] )
    {
        $key      = empty( $field ) ? array_keys( $v_info ) : $field;
    }
}
