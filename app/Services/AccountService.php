<?php

namespace App\Services;

use App\Models\Currency;
use App\Models\Account;
use Ramsey\Uuid\Uuid;
use Auth;
use App\Models\User;
use App\Http\Requests\ValueRequest;

class AccountService
{
    public function indexData()
    {
        # it is possible that there will be no entries, but that's for later
        $currency = Currency::find(1);
        $time = time();
        if ($time - strtotime($currency->updated_at) > 3600) {
            $call = curl_init(); 
            curl_setopt($call, CURLOPT_URL, 'https://api.exchangeratesapi.io/latest?symbols=USD');
            curl_setopt($call, CURLOPT_RETURNTRANSFER, 1); 
            $json = json_decode(curl_exec($call)); 
            curl_close($call);
            $currency->rate = $json->rates->USD;
            $currency->updated_at = date($time);
            $currency->save();
        }
        $accounts = Account::all()->sortBy('surname');
        $rate = $currency->rate;
        $role = User::find(Auth::id())->role ?? User::ROLE_NONE;

        return compact('accounts', 'rate', 'role');
    }

    public function add(Account $account, ValueRequest $request)
    {
        // if ($request->value < 0) return redirect()->back()->withErrors('Negative value can\'t be provided.');
        $account->value += $request->value;
        $account->save();
    }

    public function remove(Account $account, ValueRequest $request)
    {
        // if ($request->value < 0) return redirect()->back()->withErrors('Negative value can\'t be provided.');
        # remove later
        if ($request->value > $account->value) return redirect()->back()->withErrors('Can\'t remove more than account has.');
        $account->value -= $request->value;
        $account->save();
    }

    private function generateNumber(int $length = 0) {
        $numbers = range(0, 9);
        $number = '';
        for ($i = 0; $i < $length; $i++) { 
            $number .= $numbers[rand(0, count($numbers) - 1)];
        }
        return $number;
    }

    public function generateNewAccount() {
        return [
            'newUuid'     => (string) Uuid::uuid4(),
            'newName'     => (string) 'name ' . rand(1, 50),
            'newSurname'  => (string) 'surname ' . rand(1, 50),
            'newAccount'  => (string)    'LT' . $this->generateNumber(20),
            'newPersonID' => (int) $this->generateNumber(11),
            'newValue'    => (int)    0,
        ];
    }
}