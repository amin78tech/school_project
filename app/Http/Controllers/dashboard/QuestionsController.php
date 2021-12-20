<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\FormDescriptiveRequest;
use App\Http\Requests\FormTestRequest;
use App\Http\Requests\QuestionDescriptiveUpdate;
use App\Http\Requests\QuestionTestUpdate;
use App\Models\Bank;
use App\Models\Banks;
use App\Models\Descriptives;
use App\Models\Option;
use App\Models\Test;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\PseudoTypes\PositiveInteger;

class QuestionsController extends Controller
{
    public function showDescriptive()
    {
        $title='create descriptive question';
        return view('dashboard.questions.addDescriptive')
            ->with('title');
    }
    public function storeDescriptive(FormDescriptiveRequest $request)
    {
        $banks=new Bank();
        $banks->type='descriptive';
        $banks->user_id=intval(auth()->user()->id);
        $banks->save();
        Descriptives::query()->insert([
           'title'=>$request['title'],
           'bank_id'=>$banks->id,
            'score'=>$request['score']
        ]);
    }
    public function showTest()
    {
        $title='create Test question';
        return view('dashboard.questions.addTest')
            ->with('title');
    }
    public function storeTest(FormTestRequest $request)
    {
        foreach ($request['option'] as $item) {
            if ($item == null) {
                return 'فیلد شما خالی می باشد';
            }
        }
        $banks=new Bank();
        $banks->type='test';
        $banks->user_id=intval(auth()->user()->id);
        $banks->save();
        $tests=new Test();
        $tests->bank_id=$banks->id;
        $tests->title=$request['title'];
        $tests->created_at=now();
        $tests->score=$request['score'];
        $tests->save();
        foreach ($request['option'] as $item){
            $exp_opt=explode(',',$item);
            Option::query()->insert([
                'test_id'=>$tests->id,
                'option_value'=>$exp_opt[0],
                'true_false'=>$exp_opt[1],
                'created_at'=>now()
            ]);
        }
    }
    public function showQuestions()
    {
        $teacher_user_id=auth()->user()->id;
        $all_que_test=Bank::query()->select('id')->where('user_id',$teacher_user_id)->where('type','test')->get();
        $all_que_des=Bank::query()->select('id')->where('user_id',$teacher_user_id)->where('type','descriptive')->get();
        /** get test question  */
        $all_que_test_arr=[];
        if ($all_que_test->count()===1){
            $all_que_test_arr[]=Test::query()->where('bank_id',$all_que_test[0]['id'])->get();
        }else{
            foreach ($all_que_test as $item) {
                $all_que_test_arr[]=Test::query()->where('bank_id',$item['id'])->get();
            }
        }
        /** get Des question  */
        $all_que_des_arr=[];
        if ($all_que_des->count()===1){
            $all_que_des_arr[]=Descriptives::query()->where('bank_id',$all_que_des[0]['id'])->get();
        }else{
            foreach ($all_que_des as $item) {
                $all_que_des_arr[]=Descriptives::query()->where('bank_id',$item['id'])->get();
            }
        }
        $title='List Question';
        return view('dashboard.questions.questionlist')
            ->with('title',$title)
            ->with('test',$all_que_test_arr)
            ->with('descriptive',$all_que_des_arr);
    }
    public function editTestShow($id)
    {
        $get_title_test=Test::query()->where('bank_id',$id)->get();
        $get_option_test=Option::query()->where('test_id',$get_title_test[0]['id'])->get();
        $title='Edit Test Question';
        return view('dashboard.questions.editTest')
            ->with('title',$title)
            ->with('test',$get_title_test)
            ->with('option',$get_option_test);
    }

    public function editTestStore(QuestionTestUpdate $request,$id)
    {
        $get_data=$request->validated();
        $get_row=Option::query()->where('test_id',$id)->get();
        Test::query()->where('id',$id)->update([
            'title'=>$get_data['title'],
            'score'=>$get_data['score']
        ]);
        foreach ($get_row as $key=>$item){
            $exp_opt=explode(',',$request['option'][$key]);
            $item->update([
               'option_value'=>$exp_opt[0],
                'true_false'=>$exp_opt[1]
            ]);
        }
    }

    public function editDescriptiveShow($id)
    {
        $get_que=Descriptives::query()->where('bank_id',$id)->get();
        $title='Edit Descriptives Question';
        return view('dashboard.questions.editDescriptive')
            ->with('title',$title)
            ->with('descriptive',$get_que);

    }

    public function editDescriptiveStore(QuestionDescriptiveUpdate $request,$id)
    {
        $get_data=$request->validated();
        Descriptives::query()->where('bank_id',$id)->update([
            'title'=>$get_data['title'],
            'score'=>$get_data['score']
        ]);
    }
    public function delete($id)
    {
        Bank::query()->where('id',$id)->delete();
        return back();
    }
}
