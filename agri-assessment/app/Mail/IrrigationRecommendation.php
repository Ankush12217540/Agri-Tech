<?php
namespace App\Mail;

use App\Models\IrrigationSource;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class IrrigationRecommendation extends Mailable
{
    use Queueable, SerializesModels;

    public $selectedCrops;
    public $selectedTechniques;
    public $farmerName;
    public $farmerEmail;

    public function __construct($selectedCrops, $selectedTechniques, $farmerName, $farmerEmail)
    {
        $this->selectedCrops = $selectedCrops;
        $this->selectedTechniques = $selectedTechniques;
        $this->farmerName = $farmerName;
        $this->farmerEmail = $farmerEmail;
    }

    public function build()
    {
        return $this->subject('Irrigation Recommendation')
                    ->view('emails.irrigation_recommendation');
    }
}
