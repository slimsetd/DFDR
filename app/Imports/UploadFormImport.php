<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\Language;
use App\Models\UploadForm;
use Auth;
use Illuminate\Support\Facades\Date;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UploadFormImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // dd($row);
        $upload_form = new UploadForm();

        $is_exist = $upload_form->find($row['id']);
        if ($is_exist) {
        
            $is_exist->update([
                'user_id' => 2,
                'title' => $row['title'],
                'category' => $this->getCategory($row['category']),
                'description' => $row['description'],
                'publisher' => $row['publisher'],
                'date' => date('Y-m-d', strtotime($row['date'])),
                'language' => $this->getLanguage($row['language']),
                'relation' => $row['relation'],
                'file' => $row['file'],
                'right_management' => $row['right_management'],

            ]);
            $this->updateRelation($is_exist,$row);

          
           
        } else {

        
            $newUpload = UploadForm::create([
                'user_id' => 2,
                'title' => $row['title'],
                'status' => 'Approved',
                'category' => $this->getCategory($row['category']),
                'description' => $row['description'],
                'publisher' => $row['publisher'],
                'date' => date('Y-m-d', strtotime($row['date'])),
                'language' => $this->getLanguage($row['language']),
                'relation' => $row['relation'],
                'file' => $row['file'],
                'right_management' => $row['right_management'],
            ]);

            $this->insertRelation($newUpload,$row);

          
        }
    }

    public function headingRow(): int
    {
        return 2;
    }


    public function getCategory($name)
    {
      $category = Category::where('category_name', 'like', '%' .$name . '%')->first();
      return $category->id;
    }

    public function getLanguage($name)
    {
      $language = Language::where('language_name', 'like', '%' .$name . '%')->first();
      return $language->id;
    }

    public function updateRelation($data,$row)
    {
        $data->uploadFormCreator[0]->update([
            'creator' => $row['creator'],
        ]);

        $data->uploadFormSubject[0]->update([
            'subject' => $row['subject'],
        ]);

        $data->uploadFormType[0]->update([
            'type' => $row['type'],
        ]);

        $data->uploadFormFormat[0]->update([
            'format' => $row['format'],
        ]);

        $data->uploadFormContributor[0]->update([
            'contributor' => $row['contributor'],
        ]);

        $data->uploadFormIdentifier[0]->update([
            'identifier' => $row['identifier'],
        ]);

        $data->uploadFormSource[0]->update([
            'source' => $row['source'],
        ]);

        $data->uploadFormCoverage[0]->update([
            'coverage' => $row['coverage'],
        ]);

        $data->uploadFormDivision[0]->update([
            'division' => $row['division_information'],
        ]);
    }

    public function insertRelation($data,$row)
    {
        // $newUpload->uploadFormCreator()->create([
        //     'creator' => $row['creator'],
        // ]);
        $data->uploadFormCreator()->create([
            'creator' => $row['creator'],
        ]);

        $data->uploadFormSubject()->create([
            'subject' => $row['subject'],
        ]);

        $data->uploadFormType()->create([
            'type' => $row['type'],
        ]);

        $data->uploadFormFormat()->create([
            'format' => $row['format'],
        ]);

        $data->uploadFormContributor()->create([
            'contributor' => $row['contributor'],
        ]);

        $data->uploadFormIdentifier()->create([
            'identifier' => $row['identifier'],
        ]);

        $data->uploadFormSource()->create([
            'source' => $row['source'],
        ]);

        $data->uploadFormCoverage()->create([
            'coverage' => $row['coverage'],
        ]);

        $data->uploadFormDivision()->create([
            'division' => $row['division_information'],
        ]);
    }
}
