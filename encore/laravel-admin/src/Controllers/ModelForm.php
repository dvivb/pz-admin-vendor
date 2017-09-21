<?php

namespace Encore\Admin\Controllers;

use Illuminate\Support\Facades\Input;

trait ModelForm
{
    public function show($id)
    {
        return $this->edit($id);
    }

    public function update($id)
    {
        return $this->form()->update($id);
    }

    public function destroy($id)
    {
        if ($this->form()->destroy($id) && !($del_osb_error = Input::session()->pull('del_osb_error'))) {
            return response()->json([
                'status'  => true,
                'message' => trans('admin::lang.delete_succeeded'),
            ]);
        } else {
            return response()->json([
                'status'  => false,
                'message' => $del_osb_error ?: trans('admin::lang.delete_failed'),
            ]);
        }
    }

    public function store()
    {
        return $this->form()->store();
    }
}
