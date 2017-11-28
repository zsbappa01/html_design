package com.zsbappa.zakariashahed;

import android.os.Bundle;
import android.support.annotation.NonNull;
import android.support.design.widget.BottomNavigationView;
import android.support.v7.app.AppCompatActivity;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;

public class MainActivity extends AppCompatActivity implements View.OnClickListener{

    private TextView mTextMessage;
    private EditText firstInput, secondInput;
    private Button btnadd,btnmul,btnsub;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        firstInput = (EditText) findViewById(R.id.etFirst);
        secondInput = (EditText) findViewById(R.id.edtSecondInput);
        btnadd = (Button) findViewById(R.id.btnadd);
        btnmul = (Button) findViewById(R.id.btnmul);
        btnsub = (Button) findViewById(R.id.btnsub);
        mTextMessage = (TextView) findViewById(R.id.tvResult);
        btnadd.setOnClickListener(this);
        btnmul.setOnClickListener(this);
        btnsub.setOnClickListener(this);


    }

    private void addition() {
        String fistValue = firstInput.getText().toString();
        String secondValue = secondInput.getText().toString();

        int a = Integer.parseInt(fistValue);
        int b = Integer.parseInt(secondValue);
        mTextMessage.setText("Result=" + addition(a, b));

    }
    private void multiplication() {
        String fistValue = firstInput.getText().toString();
        String secondValue = secondInput.getText().toString();

        int a = Integer.parseInt(fistValue);
        int b = Integer.parseInt(secondValue);

        mTextMessage.setText("Result=" + multiplication(a, b));

    }
    private void substraction() {
        String fistValue = firstInput.getText().toString();
        String secondValue = secondInput.getText().toString();

        int a = Integer.parseInt(fistValue);
        int b = Integer.parseInt(secondValue);

        mTextMessage.setText("Result=" + substraction(a, b));
    }


    private int addition(int fistValue, int secondValue) {
        int finalValue;
        finalValue = fistValue + secondValue;

        return finalValue;
    }
    private int multiplication(int fistValue, int secondValue) {
        int finalValue;
        finalValue = fistValue * secondValue;

        return finalValue;
    }
    private int substraction(int fistValue, int secondValue) {
        int finalValue;
        finalValue = fistValue - secondValue;

        return finalValue;
    }
    public void onClick(View v) {
        if (v.getId()==R.id.btnadd){
          addition();
        }
        if (v.getId()==R.id.btnmul){
multiplication();
        }
        if (v.getId()==R.id.btnsub){
        substraction();
        }
    }
}
