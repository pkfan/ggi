<?php
//
//namespace App\Imports;
//
//use App\Models\Claim;
//use Maatwebsite\Excel\Concerns\ToModel;
//use Maatwebsite\Excel\Concerns\WithHeadingRow;
//class ClaimsImport implements ToModel,WithHeadingRow
//{
//    /**
//    * @param array $row
//    *
//    * @return \Illuminate\Database\Eloquent\Model|null
//    */
//    public function model(array $row)
//    {
//        return new Claim([
//            'rec_amt'     => $row['rec_amt'],
//            'acc_date'    => $row['acc_date'],
//            'acc_location' => $row['acc_location'],
//            'rec_reason'=>$row['rec_reason'],
//            'deb_iqama'=>$row['deb_iqama'],
//            'deb_name'=>$row['deb_name'],
//            'deb_age'=>$row['deb_age'],
//            'deb_mob'=>$row['deb_mob'],
//            'deb_type'=>$row['deb_type'],
//
//        ]);
//    }
//}
