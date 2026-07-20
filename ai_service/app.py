import os
from flask import Flask, request, jsonify
from dotenv import load_dotenv

# Load environment variables from .env file
load_dotenv()

app = Flask(__name__)

def build_prompt(data: dict) -> str:
    kalori_masuk = data.get("kalori_masuk", 0)
    kalori_terbakar = data.get("kalori_terbakar", 0)
    target_defisit = data.get("target_defisit", 500)
    
    return f"""
    Saya pengguna aplikasi diet bernama Kaloriku. Hari ini saya telah mengonsumsi {kalori_masuk} kkal dan membakar {kalori_terbakar} kkal melalui aktivitas.
    Target saya adalah defisit {target_defisit} kkal.
    Tolong berikan saran makanan yang harus saya kurangi atau aktivitas tambahan yang bisa saya lakukan agar target defisit tercapai.
    Berikan jawaban ringkas, praktis, dan mudah dipahami.
    """

@app.route("/saran-ai", methods=["POST"])
def saran_ai():
    data = request.get_json() or {}
    prompt = build_prompt(data)
    
    token = os.getenv("REPLICATE_API_TOKEN")
    if not token or token.strip() == "" or token == "your_replicate_api_key_here":
        return jsonify({
            "saran": "Kredensial IBM Granite / Replicate API belum dikonfigurasi. Silakan atur REPLICATE_API_TOKEN pada file .env di service Flask AI.",
            "status": "error_missing_credentials"
        }), 400

    try:
        from langchain_community.llms import Replicate
        
        model = Replicate(
            model="ibm-granite/granite-3.3-8b-instruct",
            replicate_api_token=token,
            model_kwargs={"max_tokens": 512, "temperature": 0.2},
        )
        
        result = model.invoke(prompt)
        return jsonify({"saran": result, "status": "success"})
    except Exception as e:
        return jsonify({
            "saran": f"Terjadi kesalahan saat memproses permintaan AI: {str(e)}. (Catatan: Pastikan kredit API Replicate / IBM Granite Anda masih aktif).",
            "status": "error_api_failure"
        }), 500

@app.route("/health", methods=["GET"])
def health_check():
    return jsonify({"status": "ok", "service": "Kaloriku Flask AI Backend"}), 200

if __name__ == "__main__":
    port = int(os.getenv("PORT", 5000))
    app.run(host="0.0.0.0", port=port, debug=True)
