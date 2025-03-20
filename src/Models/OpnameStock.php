<?php

namespace Gii\ModuleOpnameStock\Models;

use Gii\ModuleOpnameStock\Enums\OpnameStock\Activity;
use Gii\ModuleOpnameStock\Enums\OpnameStock\ActivityStatus;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Zahzah\LaravelHasProps\Concerns\HasProps;
use Zahzah\LaravelSupport\Concerns\Support\HasActivity;
use Zahzah\LaravelSupport\Models\BaseModel;
use Zahzah\ModuleTransaction\Concerns\HasTransaction;

class OpnameStock extends BaseModel{
    use HasUlids, HasTransaction, SoftDeletes, HasProps, HasActivity;

    public $incrementing  = false;
    protected $keyType    = 'string';
    protected $primaryKey = 'id';
    protected $list       = [
        'id','author_type','author_id','warehouse_type','warehouse_id','status',
        'reported_at'
    ];

    protected static function booted(): void{
      parent::booted();
      static::creating(function($query){
        if (!isset($query->opname_code)){
          $query->opname_code = static::hasEncoding('OPNAME_STOCK');
        }
      });
    }

    public function author(){return $this->morphTo();}
    public function warehouse(){return $this->morphTo();}
    public function cardStock(){
      return $this->hasOneThroughModel(
          'CardStock', 
          'Transaction',
          'reference_id',
          $this->TransactionModel()->getForeignKey(),
          $this->getKeyName(),
          $this->TransactionModel()->getKeyName()
      )->where('reference_type',$this->getMorphClass());
  }

  public function cardStocks(){
      return $this->hasManyThroughModel(
          'CardStock', 
          'Transaction',
          'reference_id',
          $this->TransactionModel()->getForeignKey(),
          $this->getKeyName(),
          $this->TransactionModel()->getKeyName()
      )->where('reference_type',$this->getMorphClass());
  }

    public static array $activityList = [
        Activity::OPNAME_STOCK->value.'_'.ActivityStatus::OPNAME_STOCK_CREATED->value    => ['flag' => 'OPNAME_STOCK_CREATED', 'message' => 'Opname stock created'],
        Activity::OPNAME_STOCK->value.'_'.ActivityStatus::OPNAME_STOCK_REPORTED->value   => ['flag' => 'OPNAME_STOCK_REPORTED', 'message' => 'Opname stock reported'],
        Activity::OPNAME_STOCK->value.'_'.ActivityStatus::OPNAME_STOCK_CANCELLED->value  => ['flag' => 'OPNAME_STOCK_CANCELLED', 'message' => 'Opname stock cancelled'],
    ];
}
