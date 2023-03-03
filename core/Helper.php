<?php

class Helper
{
    public static function flash_message($name = '', $message = '', $class = 'alert-success'): void
    {
        //We can only do something if the name isn't empty
        if (!empty($name)) {
            //No message, create it
            if (!empty($message) && empty($_SESSION[$name])) {

                if (!empty($_SESSION[$name . '_class'])) {
                    unset($_SESSION[$name . '_class']);
                }

                $_SESSION[$name] = $message;
                $_SESSION[$name . '_class'] = $class;
            } elseif (!empty($_SESSION[$name]) && empty($message)) { //Message exists, display it
                $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : 'alert-success';
                echo '<div class="alert ' . $class . ' alert-dismissible fade show">' . $_SESSION[$name] . '
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';

                unset($_SESSION[$name]);
                unset($_SESSION[$name . '_class']);
            }
        }
    }

    public static function is_login(): bool
    {
        return !!isset($_SESSION['username']);
    }

    public static function rupiah(int $number): string
    {

        return "Rp " . number_format($number, 2, ',', '.');
    }

    public static function string_month(int $month): string
    {
        return match ($month) {
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
            default => "",
        };
    }

    public static function ambil_terbayar(int $transaction_id): int|float
    {
        $db = new BaseModel();
        $transactions = $db->query("SELECT * FROM transactions WHERE id = $transaction_id");
        if($transactions[0]['installment_id'] == 0) {
            return $transactions[0]['total_price'];
        }else {
            $terbayar = 0;
            $installment = $db->query("SELECT * FROM type_of_installments WHERE id = {$transactions[0]['installment_id']}");
            $terbayar += $installment[0]['dp'];
            $tagihan = $db->query("SELECT * FROM transaction_details WHERE transaction_id = $transaction_id");
            foreach($tagihan as $hutang) {
                if($hutang['is_paid'] == 1) {
                    $terbayar += $hutang['nominal'];
                }
            }

            return $terbayar;
        }
    }
}
