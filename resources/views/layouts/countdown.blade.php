<div class="alert alert-danger alert-block text-center">
    <x-countdown :expires="new Carbon\Carbon($race->racedate)">
        <div class="row pl-4">
            <div class="col-1">
                <form action="https://www.paypal.com/donate" method="post" target="_top">
                    <input type="hidden" name="business" value="5LYFHWLMC7LKL" />
                    <input type="hidden" name="no_recurring" value="1" />
                    <input type="hidden" name="item_name" value="If you would like to help with the monthly webhost costs, domain name, and email server costs.               Much appreciated!!" />
                    <input type="hidden" name="currency_code" value="USD" />
                    <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" />
                    <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1" />
                    </form>

            </div>
            <div class="col-5">
                <h3 class="pt-3 pl-5">Countdown to {{ $race->name }}:</h3>
            </div>
            <div class="col-1"><button type="submit" class="btn btn-danger btn-sm pull-left">
                <h5 class="pt-2"><span x-text="timer.days">{{ $component->days() }}</span></button></h5>
            </div>
            <div class="col-1"><button type="submit" class="btn btn-danger btn-sm pull-left">
                <h5 class="pt-2"><span x-text="timer.hours">{{ $component->hours() }}</span></h5></button>
            </div>
            <div class="col-1"><button type="submit" class="btn btn-danger btn-sm pull-left">
                <h5 class="pt-2"><span x-text="timer.minutes">{{ $component->minutes() }}</span></button>
            </div>
            <div class="col-1"><button type="submit" class="btn btn-danger btn-sm">
                <h5 class="pt-2"><span x-text="timer.seconds">{{ $component->seconds() }}</span></button>
            </div>
        </div>
    </x-countdown>
    <div class="row pl-4">
        <div class="col-6">
        </div>
        <div class="col-1 pull-left">
            <h5>Days</h5>
        </div>
        <div class="col-1 pull-left">
            <h5>Hours</h5>
        </div>
        <div class="col-1 pull-left">
            <h5>Minutes</h5>
        </div>
        <div class="col-1 pull-left">
            <h5>Seconds</h5>
        </div>
    </div>
</div>
