<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'userName' => $this->username,
            'firstName' => $this->first_name,
            'LastName' => $this->last_name,
            'phone1' => $this->phone1,
            'phone2' => $this->phone2,
            'email' => $this->email,
            'loginCount' => $this->login_count,
            'status' => $this->status,
            'defaultLocation' => $this->default_location,
            'photoType' => $this->photo_type,
            'photoPath' => $this->photo_url,
            'createdBy' => $this->created_by,
            'createdDate' => (string) $this->created_date,
        ];
    }
}
