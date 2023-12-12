<?php
namespace App\Http\Controllers;
use Request;
use App\Models\Claim;
use App\Models\AdminDoc;
use App\Models\Supported_Doc;
use App\Models\OfficerTarget;
use Illuminate\Support\Facades\File;
class ArtController extends Controller
{
    public function cities()
    {
        $cities = [
            'الرياض', 'جدة', 'الدمام', 'مكة المكرمة', 'المدينة المنورة', 'الخبر', 'الظهران', 'الاحساء', 'Artawiya', 'الطائف',
            'جازان', 'بريدة', 'تبوك', 'القطيف', 'خميس مشيط', 'حفر الباطن', 'الجبيل', 'الخرج', 'أبها', 'حائل', 'نجران', 'ينبع', 'صبيا', 'الدوادمي',
            'بيشة', 'أبو عريش', 'القنفذة', 'محايل عسير', 'سكاكا', 'عرعر', 'عنيزة', 'القريات', 'صامطة', 'المجمعة', 'القويعية', 'أحد المسارحة', 'الرس', 'الباحة',
            'الجموم', 'رابغ', 'شرورة', 'الليث', 'رفحاء', 'عفيف', 'الخفجي', 'الدرعية', 'طبرجل', 'بيش', 'الزلفي', 'الدرب', 'سراة عبيدة', 'رجال المع',
            'الأفلاج', 'بلجرشي', 'وادي الدواسر', 'أحد رفيدة', 'بدر', 'أملج', ' رأس تنورة', 'المهد', 'البكيرية', 'البدائع', 'الحناكية', 'العلا',
            'الطوال', 'النماص', 'المجاردة', 'بقيق', 'تثليث', 'النعيرية', 'المخواة', 'الوجه', 'ضباء', 'بارق', 'خيبر', 'طريف', 'رنية', 'دومة الجندل',
            'المذنب', 'تربة', 'ظهران الجنوب', 'حوطة بني تميم', 'الخرمة', 'شقراء', 'المزاحمية', 'الأسياح', 'السليل', 'تيماء', 'الارطاوية', 'ضرمة', 'الحريق',
            'حقل', 'حريملاء', 'جلاجل', 'المبرز', 'القيصومة', 'سبت العلايا', 'صفوة', 'سيهات', 'تنومة', 'تاروت', 'ثادق', 'الثقبة'
        ];
        $citiesamtdirect = array();
        $citiesamtcollect = array();
        for ($i = 0; $i < sizeof($cities); $i++) {
            $direct = Claim::join('payment', 'payment.claim_id', '=', 'claims.id')
                ->where('payment.response_code', 000)->where('claims.acc_location', $cities[$i])->sum('payment.amount');
            array_push($citiesamtdirect, $direct);
            $collected = Claim::join('claim_collected', 'claim_collected.claim_id', '=', 'claims.id')
                ->where('claims.acc_location', $cities[$i])->sum('claims.rec_amt');
            array_push($citiesamtcollect, $collected);
        }
        $post = [$citiesamtcollect, $citiesamtdirect];
        return response($post, 200);
    }
    // languages
    public function translateLanguage($languageCode)
    {
        session()->put('language', $languageCode);
        app()->setlocale(session('language'));
        $lang = app()->getlocale();
        return back()->with('success', "language translated successfully. {$lang}");
    }
    public function officerTargetsStatistics()
    {
        // return OfficerTarget::whereMonth('end_date',7)->get();
        return view('admin.targets-statistics');
    }
    public function officerTargetsApi(Request $request)
    {
        $year = @$request->year ?? now()->year;
        $targets = OfficerTarget::with('officer')
            ->orderByDesc('created_at')
            ->when(@$request->month && $request->month != 'all', function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->whereMonth('start_date', $request->month)
                        ->orWhereMonth('end_date', $request->month);
                });
            })
            ->whereYear('start_date', $year)
            ->get();
        // return OfficerTarget::whereMonth('end_date',7)->get();
        /**
         * targets schema array
         *
         * [
         *      officer_id => ['officer_name'=>'Muhammad Amir', 'total_achieved'=>54254],
         *      34 => ['officer_name'=>'Muhammad Amir', 'total_achieved'=>5454321],
         *      67 => ['officer_name'=>'Muhammad Rizwan', 'total_achieved'=>32321],
         * ]
         */
        $transformOfficerWithTargets = [];
        foreach ($targets as $target) {
            if (!@$transformOfficerWithTargets[$target->officer_id]) {
                $transformOfficerWithTargets[$target->officer_id] = [
                    'officer_name' => $target->officer->name,
                    'total_achieved' => $target->achieved,
                    'start_date' => $target->start_date,
                    'end_date' => $target->end_date
                ];
            } else {
                $transformOfficerWithTargets[$target->officer_id] = [
                    'officer_name' => $target->officer->name,
                    'total_achieved' => $transformOfficerWithTargets[$target->officer_id]['total_achieved'] + $target->achieved,
                    'start_date' => $target->start_date,
                    'end_date' => $target->end_date
                ];
            }
        }
        return $transformOfficerWithTargets;
    }
    public function deleteAdditionalDocs($doc_id)
    {
        $additionalDocs = AdminDoc::find($doc_id);
        File::delete(storage_path('/app/public/' . $additionalDocs->document));
        $additionalDocs->delete();
        return back()->with('success', 'Additional Document deleted');
    }
    public function deleteSupportiveDocs($doc_id)
    {
        $supportedDoc = Supported_Doc::find($doc_id);
        File::delete(storage_path('/app/public/' . $supportedDoc->doc_name));
        $supportedDoc->delete();
        return back()->with('success', 'Supportive Document deleted');
    }
}



