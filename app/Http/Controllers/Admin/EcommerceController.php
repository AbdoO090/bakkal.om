<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cities;
use App\Models\DeliveryCharge;
use App\Models\States;
use App\Models\Tax;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class EcommerceController extends Controller
{
    public function countryTaxList(Request $request)
    {
        if ($request->ajax()) {
            $data = Tax::query();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btn = '<div class="action__buttons">';
                    $btn = $btn . '<a href="javascript:void(0)" class="btn-action" data-bs-toggle="modal" data-bs-target="#editModal' . $data->id . '"><i class="fa-solid fa-pen-to-square"></i></a>';
                    $btn = $btn . '</div>';
                    return $btn;
                })
                ->editColumn('status', function ($data) {
                    if ($data->status == ACTIVE) {
                        return '<span class="status active">Active</span>';
                    } else {
                        return '<span class="status blocked">Inactive</span>';
                    }
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
        $data['title'] = __('Tax List');
        $data['taxes'] = Tax::get();
        return view('admin.pages.tax.country', $data);
    }

    public function countryTaxStore(Request $request)
    {
        $this->validate($request, [
            'country' => 'required',
            'percentage' => 'required'
        ]);

        $tax = Tax::where('country', $request->country)->first();
        if (!is_null($tax)) {
            $update = $tax->update([
                'country' => $request->country,
                'percentage' => $request->percentage,
            ]);
            if (!empty($update)) {
                return redirect()->back()->with('success', __('Country tax already exist. It Updated!'));
            }
        } else {
            $store = Tax::create([
                'country' => $request->country,
                'percentage' => $request->percentage,
            ]);
            if (!empty($store)) {
                return redirect()->back()->with('success', __('Country tax added!'));
            }
        }
        return redirect()->back()->with('error', __('Something went wrong'));
    }

    public function countryTaxUpdate(Request $request, $id)
    {
        $id = decrypt($id);
        $tax = Tax::where('id', $id)->first();
        if (!is_null($tax)) {
            $update = $tax->update([
                'country' => $request->country,
                'percentage' => $request->percentage,
                'status' => $request->status,
            ]);
            if (!empty($update)) {
                return redirect()->back()->with('success', __('Country tax Updated!'));
            }
        }
        return redirect()->back()->with('error', __('Something went wrong'));
    }

    public function countryDCList(Request $request)
    {
        if ($request->ajax()) {
            $data = DeliveryCharge::query();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btn = '<div class="action__buttons">';
                    $btn = $btn . '<a href="javascript:void(0)" class="btn-action" data-bs-toggle="modal" data-bs-target="#editModal' . $data->id . '"><i class="fa-solid fa-pen-to-square"></i></a>';
                    $btn = $btn . '</div>';
                    return $btn;
                })
                ->editColumn('status', function ($data) {
                    if ($data->status == ACTIVE) {
                        return '<span class="status active">Active</span>';
                    } else {
                        return '<span class="status blockedr">Inactive</span>';
                    }
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
        $data['title'] = __('Delivery Charge List');
        $data['delivery_charges'] = DeliveryCharge::get();
        return view('admin.pages.delivery-charge.country', $data);
    }

    public function countryDCStore(Request $request)
    {
        $tax = DeliveryCharge::where('country', $request->country)->first();
        if (!is_null($tax)) {
            $update = $tax->update([
                'country' => $request->country,
                'charge' => $request->charge,
            ]);
            if (!empty($update)) {
                return redirect()->back()->with('success', __('Delivery charge already exist. It Updated!'));
            }
        } else {
            $store = DeliveryCharge::create([
                'country' => $request->country,
                'charge' => $request->charge,
            ]);
            if (!empty($store)) {
                return redirect()->back()->with('success', __('Delivery charge added!'));
            }
        }
        return redirect()->back()->with('error', __('Something went wrong'));
    }

    public function countryDCUpdate(Request $request, $id)
    {
        $id = decrypt($id);
        $tax = DeliveryCharge::where('id', $id)->first();
        if (!is_null($tax)) {
            $update = $tax->update([
                'country' => $request->country,
                'charge' => $request->charge,
                'status' => $request->status,
            ]);
            if (!empty($update)) {
                return redirect()->back()->with('success', __('Country tax Updated!'));
            }
        }
        return redirect()->back()->with('error', __('Something went wrong'));
    }

    public function citiesList(Request $request)
    {
        if ($request->ajax()) {
            $data = Cities::query();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btn = '<div class="action__buttons">';
                    $btn = $btn . '<a href="javascript:void(0)" class="btn-action" data-bs-toggle="modal" data-bs-target="#editModal' . $data->id . '"><i class="fa-solid fa-pen-to-square"></i></a>';
                    $btn = $btn . '<a href="' . route('admin.cities_delete', $data->id) . '" class="btn-action delete"><i class="fas fa-trash-alt"></i></a>';
                    $btn = $btn . '</div>';
                    return $btn;
                })
                ->editColumn('status', function ($data) {
                    if ($data->Status == ACTIVE) {
                        return '<span class="status active">Active</span>';
                    } else {
                        return '<span class="status blocked">Inactive</span>';
                    }
                })
                ->editColumn('state_id', function ($data) {
                    return $data->state->name_en;
                })
                ->rawColumns(['action', 'status', 'state_id'])
                ->make(true);
        }
        $data['title'] = __('State List');
        $data['delivery_charges'] = Cities::get();
        $data['States'] = States::get();
        return view('admin.pages.delivery-charge.Cities', $data);
    }

    public function citiesStore(Request $request)
    {
        Cities::create([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'state_id'   => $request->state_id,
            'charge'   => $request->charge,
        ]);
        return redirect()->back()->with('success', __('State added!'));
    }


    public function cities_update(Request $request, $id)
    {
        $id = decrypt($id);
        $State = Cities::where('id', $id)->first();
        if (!is_null($State)) {
            $update = $State->update([
                'name_en' => $request->name_en,
                'name_ar' => $request->name_ar,
                'Status' => $request->status,
                'state_id'   => $request->state_id,
                'charge'   => $request->charge,
            ]);
            if (!empty($update)) {
                return redirect()->back()->with('success', __('State Updated!'));
            }
        }
        return redirect()->back()->with('error', __('Something went wrong'));
    }

    public function cities_delete($id)
    {
        $delete = Cities::Where('id', $id);
        if ($delete) {
            $delete->delete();
            return redirect()->back()->with('success', __('Successfully Deleted !'));
        }
        return redirect()->back()->with('error', __('Something went wrong'));
    }



    public function statesList(Request $request)
    {
        if ($request->ajax()) {
            $data = States::query();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btn = '<div class="action__buttons">';
                    $btn = $btn . '<a href="javascript:void(0)" class="btn-action" data-bs-toggle="modal" data-bs-target="#editModal' . $data->id . '"><i class="fa-solid fa-pen-to-square"></i></a>';
                    $btn = $btn . '<a href="' . route('admin.States_delete', $data->id) . '" class="btn-action delete"><i class="fas fa-trash-alt"></i></a>';
                    $btn = $btn . '</div>';
                    return $btn;
                })
                ->editColumn('status', function ($data) {
                    if ($data->Status == 1) {
                        return '<span class="status active">Active</span>';
                    } else {
                        return '<span class="status blocked">Inactive</span>';
                    }
                })
                ->editColumn('country_id', function ($data) {
                    if ($data->country_id == 1) {
                        return '<span class="status"> Oman </span>';
                    }
                })
                ->rawColumns(['action', 'status', 'country_id'])
                ->make(true);
        }
        $data['title'] = __('Governorate List');
        $data['delivery_charges'] = States::get();
        return view('admin.pages.delivery-charge.States', $data);
    }

    public function StatesStore(Request $request)
    {
        States::create([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'country_id'   => 1,
        ]);
        return redirect()->back()->with('success', __('Governorate added!'));
    }


    public function States_update(Request $request, $id)
    {
        $id = decrypt($id);
        $State = States::where('id', $id)->first();
        if (!is_null($State)) {
            $update = $State->update([
                'name_en' => $request->name_en,
                'name_ar' => $request->name_ar,
                'Status' => $request->status,
            ]);
            if (!empty($update)) {
                return redirect()->back()->with('success', __('Governorate Updated!'));
            }
        }
        return redirect()->back()->with('error', __('Something went wrong'));
    }

    public function States_delete($id)
    {
        $delete = States::Where('id', $id);
        if ($delete) {
            $delete->delete();
            return redirect()->back()->with('success', __('Successfully Deleted !'));
        }
        return redirect()->back()->with('error', __('Something went wrong'));
    }
    
}

