<?php

namespace App\Http\Controllers\API;
use App\Repositories\ContactRepository;
use Illuminate\Http\Request;

class SearchAPIController extends AppBaseController
{

      /** @var  ContactRepository */
      private $contactRepository;



      public function __construct(ContactRepository $contactRepo)
      {
          $this->contactRepository = $contactRepo;
      }


    public function fetchContact(Request $request)
    {
        $query = $request->get('query');

        $results = $this->contactRepository->search($query);

        return response()->json($results);
    }

}
