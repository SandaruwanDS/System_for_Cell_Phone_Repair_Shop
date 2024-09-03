<?php
 
namespace App\Http\Controllers; 
use Illuminate\Http\Request;
use App\Models\Category;
use Datatables;
 
class CategoryController extends Controller
{
    public function index()
    {
        if(request()->ajax()) {
            return datatables()->of(Category::select('*'))
            ->addColumn('action', 'Category-action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('Category');
    }
 
    public function store(Request $request)
    {  
  
        $CategoryId = $request->id;
  
        $Category   =   Category::updateOrCreate(
                    [
                     'id' => $CategoryId
                    ],
                    [
                    'code' => $request->code, 
                    'cate_name' => $request->cate_name,
                    ]);    
                          
        return Response()->json($Category);
    }
 
    public function edit(Request $request)
    {   
        $where = array('id' => $request->id);
        $Category  = Category::where($where)->first();
       
        return Response()->json($Category);
    }
 
    public function destroy(Request $request)
    {
        $Category = Category::where('id',$request->id)->delete();
       
        return Response()->json($Category);
    }
}