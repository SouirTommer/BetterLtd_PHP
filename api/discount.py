from flask import Flask, request, jsonify
from flask_cors import CORS

app = Flask(__name__)
CORS(app)

@app.route("/api/discountcaculator/<old_price>")
def discount (old_price):

    old_price = float(old_price)

    
    if (old_price >= 10000):
        new_price = old_price * (1-0.12)
    elif (old_price >= 5000):
        new_price = old_price * (1-0.08)
    elif (old_price >= 3000):
        new_price = old_price * (1-0.03)
    else:
        new_price = old_price
    
    return str("%.1f" % new_price)

if __name__ == '__main__':
    app.run(host='0.0.0.0', port =3000, debug=True)
