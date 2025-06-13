<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * 新規登録後のリダイレクト先
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * コンストラクタ：ゲストのみアクセス可能
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * 新規ユーザー登録処理
     */
    public function register(Request $request)
    {
        if ($request->isMethod('post')) {
            // バリデーション
            $request->validate(
                [
                    'username' => 'required|string|min:2|max:12',
                    'mail' => 'required|email|unique:users,mail|min:5|max:40',
                    'password' => 'required|string|alpha_num|min:8|max:20|confirmed',
                    'password_confirmation' => 'required|string|alpha_num|min:8|max:20|same:password',
                ],
                [
                    'username.required' => '※ユーザー名は必須です。',
                    'username.min' => '※ユーザー名は2文字以上で入力してください。',
                    'username.max' => '※ユーザー名は12文字以内で入力してください。',

                    'mail.required' => '※メールアドレスは必須です。',
                    'mail.email' => '※メールアドレスの形式が正しくありません。',
                    'mail.unique' => '※このメールアドレスは既に使われています。',
                    'mail.min' => '※メールアドレスは5文字以上で入力してください。',
                    'mail.max' => '※メールアドレスは40文字以内で入力してください。',

                    'password.required' => '※パスワードは必須です。',
                    'password.alpha_num' => '※パスワードは英数字で入力してください。',
                    'password.min' => '※パスワードは8文字以上で入力してください。',
                    'password.max' => '※パスワードは20文字以内で入力してください。',
                    'password.confirmed' => '※パスワード確認が一致しません。',

                    'password_confirmation.required' => '※パスワード確認は必須です。',
                    'password_confirmation.alpha_num' => '※パスワード確認は英数字で入力してください。',
                    'password_confirmation.min' => '※パスワード確認は8文字以上で入力してください。',
                    'password_confirmation.max' => '※パスワード確認は20文字以内で入力してください。',
                    'password_confirmation.same' => '※パスワードと一致していません。',
                ]
            );

            // ユーザー作成
            User::create([
                'username' => $request->input('username'),
                'mail' => $request->input('mail'),
                'password' => \Hash::make($request->input('password')),
            ]);

            // 登録完了メッセージ用にセッションへ保存
            \Session::flash('username', $request->input('username'));

            return redirect('added');
        }

        return view('auth.register');
    }

    /**
     * 登録完了画面表示
     */
    public function added()
    {
        return view('auth.added');
    }
}
