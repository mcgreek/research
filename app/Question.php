<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public function screen()
    {
        return $this->belongsTo(Screen::class);
    }

	public function choices()
	{
		return $this->hasMany(Choice::class);
	}

    /**
     * Get questions for specified screen
     * 
     * @param  int    $screenId [description]
     * @return [type]           [description]
     */
    public function getForScreen(int $screenId)
    {
        return $this->where('screen_id', $screenId)
                ->orderBy('question_order_number', 'asc')
                ->get();
    }
}
