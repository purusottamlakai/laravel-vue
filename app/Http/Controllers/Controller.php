<?php

namespace App\Http\Controllers;

abstract class Controller
{
    protected int $statusCode = 200;

    /**
    * Sets the status code for each request.
    *
    * @param int $statusCode
    */
   public function setStatusCode($statusCode)
   {
       $this->statusCode = $statusCode;
       return $this;
   }

   /**
    * Returns the current status code.
    *
    * @return int status code
    */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
    * Returns a success message along with status code and data.
    *
    * @param array $data
    *
    * @return Response
    */
    public function respondWithSuccess($data)
    {
        return $this->setStatusCode(200)->respond($data);
    }

   /**
    * Returns a success message along with status code.
    *
    * @param string $message
    *
    * @return Response
    */
   public function respondWithSuccessMessage($message)
   {
       return $this->setStatusCode(200)->respond(['success' => true, 'message' => $message]);
   }

   /**
    * Respond with failure message.
    *
    * @param string $message
    *
    * @return
    */
   public function respondWithFailureMessage($message)
   {
       return $this->respond([
           'success' => false,
           'message' => $message,
       ]);
   }

   /**
    * Returns the error message along with not found status code.
    *
    * @param string $message
    *
    * @return mixed
    */
   public function respondNotFound($message = 'Not Found')
   {
       return $this->setStatusCode(404)->respondWithFailureMessage($message);
   }

   /**
    * Returns a json formatted data through respond() function.
    *
    * @param string $messsage
    * @param mixed  $data
    *
    * @return mixed
    */
   public function respondWithError($data)
   {
       return $this->respond($data);
   }

   /**
    * @param string $message
    *
    * @return mixed
    */
   public function respondInternalError($message = 'Internal Error')
   {
       return $this->setStatusCode(500)
           ->respondWithFailureMessage($message)
       ;
   }

   /**
    * Returns a json formatted data along with HTTP create status code.
    *
    * @param string $message
    * @param mixed  $token
    *
    * @return json
    */
   public function respondCreated(array $data)
   {
       return $this->setStatusCode(201)->respond($data);
   }

   /**
    * Returns a json formatted data for invalid parameters along with HTTP status code.
    *
    * @param string $message
    *
    * @return json
    */
   public function respondInvalidParameters($message = 'Invalid Parameters')
   {
       return $this->setStatusCode(400)
           ->respondWithFailureMessage($message)
       ;
   }

   /**
    * Returns a json formatted data for not found content.
    *
    * @param string $message
    *
    * @return json
    */
   public function respondNoTag($message = 'No Tag Found')
   {
       return $this->setStatusCode(404)
           ->respondWithFailureMessage($message)
       ;
   }

   /**
    * Returns a json formatted data with pagination information.
    *
    * @param array      $data
    * @param object     $paginator
    * @param array      $package
    * @param int        $limit
    * @param array      $params    Optional data
    * @param null|mixed $extraInfo
    *
    * @return json
    */
   public function respondWithPagination($data, $paginator, $extraInfo = null, $limit = 10)
   {
       return $this->setStatusCode(200)
           ->respond([
               'data' => array_merge([
                   'total' => $paginator->total(),
                   'pages' => ceil($paginator->total() / $limit),
                   'per_page' => $limit,
                   'current_page' => $paginator->currentPage(),
                   'last_page' => $paginator->lastPage(),
                   'next_page_url' => $paginator->nextPageUrl(),
                   'prev_page_url' => $paginator->previousPageUrl(),
                   'extra_info' => empty($extraInfo) ? null : $extraInfo,
               ], $data),
           ])
       ;
   }

   /**
    * Returns for no content.
    *
    * @param string $message
    *
    * @return mixed
    */
   public function respondNoContent()
   {
       return $this->setStatusCode(204)->respond([]);
   }

   /**
    * Returns the error message along with forbidden status code.
    *
    * @param string $message
    *
    * @return mixed
    */
   public function respondForbidden($message = 'This action is unauthorize')
   {
       return $this->setStatusCode(403)
           ->respondWithFailureMessage($message)
       ;
   }

   /**
    * Returns the error message along with unathorized status code.
    *
    * @param string $message
    *
    * @return mixed
    */
   public function respondUnathorized($message = 'Authentication Failure')
   {
       return $this->setStatusCode(401)
           ->respondWithFailureMessage($message)
       ;
   }

   /**
    * Returns a json formatted data through Response class.
    *
    * @param mixed $data
    * @param array $headers
    *
    * @return mixed
    */
   protected function respond($data, $headers = [])
   {
       return response()->json($data, $this->getStatusCode(), $headers);
   }
}
