<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'test_performed_id',
        'test_report_item_id',
        'value',
    ];
    public function report_item(){
        return $this->belongsTo(TestReportItem::class,"test_report_item_id");
    }
}
