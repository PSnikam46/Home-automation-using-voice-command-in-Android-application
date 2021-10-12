package in.df4u.piot;

import android.content.ActivityNotFoundException;
import android.content.Intent;
import android.speech.RecognizerIntent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.webkit.WebView;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageButton;
import android.widget.TextView;
import android.widget.Toast;

import java.util.ArrayList;
import java.util.Locale;

public class MainActivity extends AppCompatActivity {

    EditText ip, command;
    Button ipbtn, execbtn;
    ImageButton voicebtn;
    WebView webvu;


    String ipaddr;
    String url;
    String commandstr;
    private final int REQ_CODE_SPEECH_INPUT = 100;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        ip = (EditText) findViewById(R.id.iptxt);
        ipbtn = (Button) findViewById(R.id.ipbtn);
        command = (EditText) findViewById(R.id.command);
        execbtn = (Button) findViewById(R.id.execbtn);
        voicebtn = (ImageButton) findViewById(R.id.voicebtn);
        webvu = (WebView) findViewById(R.id.webvu);



        ipbtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                ipaddr = ip.getText().toString();
            }
        });

        voicebtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                promptSpeechInput();
            }
        });

        execbtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                commandstr = command.getText().toString();

                url = "http://" + ipaddr + "?comm=" + commandstr.replace(" ","_");
                webvu.loadUrl(url);
            }
        });

    }

    private void promptSpeechInput() {
        Intent intent = new Intent(RecognizerIntent.ACTION_RECOGNIZE_SPEECH);
        intent.putExtra(RecognizerIntent.EXTRA_LANGUAGE_MODEL,
                RecognizerIntent.LANGUAGE_MODEL_FREE_FORM);
        intent.putExtra(RecognizerIntent.EXTRA_LANGUAGE, Locale.getDefault());
        intent.putExtra(RecognizerIntent.EXTRA_PROMPT,
                "Say Something");
        try {
            startActivityForResult(intent, REQ_CODE_SPEECH_INPUT);
        } catch (ActivityNotFoundException a) {
            Toast.makeText(getApplicationContext(),
                    "Speech Not Supported",
                    Toast.LENGTH_SHORT).show();
        }
    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {
        super.onActivityResult(requestCode, resultCode, data);

        switch (requestCode) {
            case REQ_CODE_SPEECH_INPUT: {
                if (resultCode == RESULT_OK && null != data) {

                    ArrayList<String> result = data
                            .getStringArrayListExtra(RecognizerIntent.EXTRA_RESULTS);
                            command.setText(result.get(0));
                            url = "http://" + ipaddr + "?comm=" + result.get(0).replace(" ","_");
                            webvu.loadUrl(url);
                }
                break;
            }

        }
    }
}