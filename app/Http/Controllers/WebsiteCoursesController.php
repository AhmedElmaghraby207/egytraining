<?php

namespace App\Http\Controllers;

use App\Category;
use App\Certificate;
use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use MongoDB\Driver\Exception\Exception;
use Netshell\Paypal\Facades\Paypal;
use PayPal\Api\Currency;
use PayPal\Api\Payout;
use PayPal\Api\PayoutItem;
use PayPal\Api\PayoutSenderBatchHeader;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use PHPUnit\Util\TestDox\ResultPrinter;

class WebsiteCoursesController extends Controller
{
    public function index()
    {
        $courses = Course::paginate(3);
        $categories = Category::all();
        return view('website.courses.index', compact('courses', 'categories'));
    }

    //==========================================================================================//
    public function show($slug)
    {
        $course = Course::findBySlugOrFail($slug);
        return view('website.courses.show', compact('course'));
    }

    //==========================================================================================//
    public function create()
    {
        $this->middleware('auth');
        $categories = Category::all();
        return view('website.courses.create', compact('categories'));
    }

    //==========================================================================================//
    public function store(Request $request)
    {
        $this->middleware('auth');
        $user = Auth::user()->id;
        $this->validate($request, [
            'name' => 'required|unique:courses',
            'category_id' => 'required',
            'video_link' => 'required_if:check,0',
            'video' => 'nullable|mimetypes:video/avi,video/mp4,video/mpeg,video/quicktime',
            'cover' => 'image'
        ]);

        if ($video = $request->file('video'))
        {
            if($cover = $request->file('cover'))
            {
                $cover_new_name = time() . $cover->getClientOriginalName();
                $cover->move('public/uploads/courses', $cover_new_name);

                $video_new_name = time() . $video->getClientOriginalName();
                $video->move('public/uploads/courses', $video_new_name);
                $course = Course::create([
                    'name' => $request->name,
                    'needs' => $request->needs,
                    'description' => $request->description,
                    'cover' => 'public/uploads/courses/' . $cover_new_name,
                    'category_id' => $request->category_id,
                    'coach_id' => $user,
                    'video' => 'public/uploads/courses/' . $video_new_name,
                    'video_link' => $request->video_link,
                    'male' => $request->male,
                    'female' => $request->female,
                    'status' => $request->status,
                    'price' => $request->price,
                ]);
                Session::flash('success', 'تم إضافة الدورة بنجاح, بإنتظار الموافقة على النشر');
                return redirect()->route('courses.index');
            }
            else
            {
                $video_new_name = time() . $video->getClientOriginalName();
                $video->move('public/uploads/courses', $video_new_name);
                $course = Course::create([
                    'name' => $request->name,
                    'needs' => $request->needs,
                    'description' => $request->description,
                    'category_id' => $request->category_id,
                    'coach_id' => $user,
                    'video' => 'public/uploads/courses/' . $video_new_name,
                    'video_link' => $request->video_link,
                    'male' => $request->male,
                    'female' => $request->female,
                    'status' => $request->status,
                    'price' => $request->price,
                ]);
                Session::flash('success', 'تم إضافة الدورة بنجاح, بإنتظار الموافقة على النشر');
                return redirect()->route('courses.index');
            }
        }
        else
        {
            if($cover = $request->file('cover'))
            {
                $cover_new_name = time() . $cover->getClientOriginalName();
                $cover->move('public/uploads/courses', $cover_new_name);

                $course = Course::create([
                    'name' => $request->name,
                    'needs' => $request->needs,
                    'description' => $request->description,
                    'cover' => 'public/uploads/courses/' . $cover_new_name,
                    'category_id' => $request->category_id,
                    'coach_id' => $user,
                    'video_link' => $request->video_link,
                    'male' => $request->male,
                    'female' => $request->female,
                    'status' => $request->status,
                    'price' => $request->price,
                ]);
                Session::flash('success', 'تم إضافة الدورة بنجاح, بإنتظار الموافقة على النشر');
                return redirect()->route('courses.index');
            }
            else
            {
                $course = Course::create([
                    'name' => $request->name,
                    'needs' => $request->needs,
                    'description' => $request->description,
                    'category_id' => $request->category_id,
                    'coach_id' => $user,
                    'video_link' => $request->video_link,
                    'male' => $request->male,
                    'female' => $request->female,
                    'status' => $request->status,
                    'price' => $request->price,
                ]);
                Session::flash('success', 'تم إضافة الدورة بنجاح, بإنتظار الموافقة على النشر');
                return redirect()->route('courses.index');
            }
        }
    }

    //==========================================================================================//
    public function edit($slug)
    {
        $course = Course::findBySlugOrFail($slug);
        $categories = Category::all();
        $certificate = Certificate::where('course_id', $course->id)->first();

        return view('website.courses.edit', compact('course', 'categories', 'certificate'));
    }

    //==========================================================================================//
    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|unique:courses,slug'.$course->$id,
            'category_id' => 'required',
//            'video_link' => 'required_if:check,0|url',
            'video' => 'nullable|mimetypes:video/avi,video/mp4,video/mpeg,video/quicktime',
            'cover' => 'image'
        ]);

        if ($video = $request->file('video'))
        {

            if($cover = $request->file('cover'))
            {
                $cover_new_name = time() . $cover->getClientOriginalName();
                $cover->move('public/uploads/courses', $cover_new_name);

                $video_new_name = time() . $video->getClientOriginalName();
                $video->move('public/uploads/courses', $video_new_name);

                $course->name = $request->name;
                $course->needs = $request->needs;
                $course->description = $request->description;
                $course->start_at = $request->start_at;
                $course->finish_at = $request->finish_at;
                $course->cover = 'public/uploads/courses/' . $cover_new_name;
                $course->category_id = $request->category_id;
                $course->video = 'public/uploads/courses/' . $video_new_name;
                $course->video_link = $request->video_link;
                $course->male = $request->male;
                $course->female = $request->female;
                $course->status = $request->status;
                $course->price = $request->price;
                $course->save();

                Session::flash('info', 'تم تعديل الدورة بنجاح');
                return redirect()->route('courses.show', $course->slug);
            }
            else
            {
                $video_new_name = time() . $video->getClientOriginalName();
                $video->move('public/uploads/courses', $video_new_name);

                $course->name = $request->name;
                $course->needs = $request->needs;
                $course->description = $request->description;
                $course->category_id = $request->category_id;
                $course->start_at = $request->start_at;
                $course->finish_at = $request->finish_at;
                $course->video = 'public/uploads/courses/' . $video_new_name;
                $course->video_link = $request->video_link;
                $course->male = $request->male;
                $course->female = $request->female;
                $course->status = $request->status;
                $course->price = $request->price;
                $course->save();

                Session::flash('info', 'تم تعديل الدورة بنجاح');
                return redirect()->route('courses.show', $course->slug);
            }
        }
        else
        {
            if($cover = $request->file('cover'))
            {
                $cover_new_name = time() . $cover->getClientOriginalName();
                $cover->move('public/uploads/courses', $cover_new_name);

                $course->name = $request->name;
                $course->needs = $request->needs;
                $course->description = $request->description;
                $course->start_at = $request->start_at;
                $course->finish_at = $request->finish_at;
                $course->cover = 'public/uploads/courses/' . $cover_new_name;
                $course->category_id = $request->category_id;
                $course->video_link = $request->video_link;
                $course->male = $request->male;
                $course->female = $request->female;
                $course->status = $request->status;
                $course->price = $request->price;
                $course->save();

                Session::flash('info', 'تم تعديل الدورة بنجاح');
                return redirect()->route('courses.show', $course->slug);
            }
            else
            {
                $course->name = $request->name;
                $course->needs = $request->needs;
                $course->description = $request->description;
                $course->start_at = $request->start_at;
                $course->finish_at = $request->finish_at;
                $course->category_id = $request->category_id;
                $course->video_link = $request->video_link;
                $course->male = $request->male;
                $course->female = $request->female;
                $course->status = $request->status;
                $course->price = $request->price;
                $course->save();

                Session::flash('info', 'تم تعديل الدورة بنجاح');
                return redirect()->route('courses.show', $course->slug);
            }
        }
    }

    //==========================================================================================//
    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();
        Session::flash('error', 'تم حذف الدورة والشهادة بنجاح');
        return redirect()->route('courses.index');
    }

    //==========================================================================================//
    public function publish($id)
    {
        $course = Course::findOrFail($id);

        $course->published = 1;

        $course->save();

        Session::flash('success', 'تم نشر الدورة ينجاح');
        return redirect()->back();
    }

    //==========================================================================================//
    public function unPublish($id)
    {
        $course = Course::findOrFail($id);

        $course->published = 0;

        $course->save();

        Session::flash('warning', 'تم إيقاف نشر الدورة بنجاح');
        return redirect()->back();
    }

    //==========================================================================================//
    public function complete($id)
    {
        $course = Course::findOrFail($id);

        $course->completed = 1;

        $course->save();

        Session::flash('success', 'تم إكتمال الدورة ينجاح');
        return redirect()->back();
    }

    //==========================================================================================//
    public function unComplete($id)
    {
        $course = Course::findOrFail($id);

        $course->completed = 0;

        $course->save();

        Session::flash('info', 'تم إعادة بث الدورة بنجاح');
        return redirect()->back();
    }

    //==========================================================================================//
    public function join($id)
    {
        $user = Auth::user();
        $course = Course::findOrFail($id);
        $user->courses()->attach($course);
        Session::flash('success','تم إشتراكك فى الدورة بنجاح');
        return redirect()->back();

    }

    //==========================================================================================//
    public function out($id)
    {
        $user = Auth::user();
        $course = Course::findOrFail($id);
        $user->courses()->detach($course);
        Session::flash('error','تم الانسحاب من الدورة بنجاح');
        return redirect()->back();

    }

    //==========================================================================================//
    //==========================================================================================//
    public function payNow(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        Session::put('course_slug', $course->slug);
        Session::put('course_id', $course->id);
        if($course)
        {
            $paypal_class = new PaypalController();
            return $paypal_class->getCheckout('USD', $course->description, $course->price);
        }
        else
        {
            return back();
        }
    }

    //==========================================================================================//
    public function getDone(Request $request)
    {
        $id = $request->get('paymentId');
        $token = $request->get('token');
        $payer_id = $request->get('PayerID');

        $paypal_class = new PaypalController();

        $method = $paypal_class->getDone($id, $token, $payer_id);

        $user = Auth::user();
        $course_id = session()->get('course_id');
        $course = Course::findOrFail($course_id);
        $user->courses()->attach($course);
        //Session::flash('success','تم إشتراكك فى الدورة بنجاح');
        session()->put('finally', $method);
        return redirect()->route('finally');

    }

    //==========================================================================================//
    public function finally_payment()
    {
        if (session()->has('finally'))
        {
            $method = session()->get('finally');
            session()->forget('finally');

            $course_slug = session()->get('course_slug');
            //session()->forget('course_id');

            return view('show_paypal_state', ['method' => $method, 'course_slug' => $course_slug]);
        }
        else
        {
            return redirect()->route('courses.index');
        }
    }

    //==========================================================================================//
    public function getCancel(Request $request)
    {
        return view('courses.index');
    }

    //==========================================================================================//
    private $_apiContext;

    public function __construct()
    {
        $this->_apiContext = PayPal::ApiContext(
            config('paypal.client_id'),
            config('paypal.secret'));

        $this->_apiContext->setConfig(array(
            'mode' => config('paypal.mode'),
            'service.EndPoint' => config('paypal.link_mode'),
            'http.ConnectionTimeOut' => config('paypal.timeout'),
            'log.LogEnabled' => config('paypal.enable_log'),
            'log.FileName' => storage_path('logs/paypal.log'),
            'log.LogLevel' => 'FINE'
        ));

    }

    public function payout_create()
    {
        return view('website.profiles.getMoney');
    }

    public function payout_submit(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'money' => 'required',
            'description' => 'required'
        ]);

        $payouts    =   new Payout();
        $senderBatchHeader  = new PayoutSenderBatchHeader();

        $senderBatchHeader->setSenderBatchId(uniqid())
            ->setEmailSubject($request->description);

        $senderItem1    =   new PayoutItem();
        $senderItem1->setRecipientType('Email')
//            ->setNote($request->description)
            ->setReceiver($request->email)
            ->setSenderItemId(uniqid())
            ->setAmount(new Currency('{
        "value":'.$request->money.',
        "currency":"USD"
        }'));

        $payouts->setSenderBatchHeader($senderBatchHeader)
            ->addItem($senderItem1);

        $request    =   clone $payouts;

        $output =   $payouts->create(null, $this->_apiContext);
//        dd($output);
        Session::flash('success', 'تم الارسال بنجاح');
//        return $output;
        return redirect()->route('my_profile.index');
    }

    //==========================================================================================//
    public function rateCourse(Request $request)
    {
        $this->validate($request, ['rate' => 'required']);

        $course = Course::findOrFail($request->id);
        $rating = new \willvincent\Rateable\Rating;
        $rating->rating = $request->rate;
        $rating->user_id = Auth::user()->id;
        $course->ratings()->save($rating);
        return redirect()->back();
    }
}
