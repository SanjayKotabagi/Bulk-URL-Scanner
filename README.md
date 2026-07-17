# SOC URL Intelligence Panel

A lightweight SOC analyst utility for performing bulk URL reputation checks using the VirusTotal API.

This tool was built for security analysts who need to quickly investigate URLs without manually opening VirusTotal for every IOC.

---

## Features

- Bulk URL scanning
- VirusTotal API Integration
- Automatic URL normalization
- URL defanging (IOC safe sharing)
- Malicious / Suspicious / Clean verdict
- Simple dark SOC dashboard
- Copy investigation results
- Lightweight PHP application
- No database required

---

## Screenshot

(Add screenshot here)

---

## Tech Stack

- PHP
- HTML
- CSS
- JavaScript
- VirusTotal API

---

## Folder Structure

```
project/
│
├── url_index.php      # Main dashboard
├── url_scan.php       # VirusTotal API handler
└── README.md
```

---

## How It Works

1. Paste URLs (one per line)
2. Click **Run Scan**
3. Tool automatically

- Normalizes URLs
- Queries VirusTotal
- Defangs URLs
- Displays reputation
- Allows copying investigation results

---

## Sample Output

```
Sanitized URL
hxxps://example[.]com/login

VT Score
M:12 S:3 H:81

Verdict
Malicious
```

---

## Installation

Clone repository

```bash
git clone https://github.com/yourusername/SOC-URL-Intelligence-Panel.git
```

Move project to your web server.

Example (XAMPP)

```
htdocs/
    SOC-URL-Intelligence-Panel/
```

Open

```
http://localhost/SOC-URL-Intelligence-Panel/
```

---

## VirusTotal API Setup

Open

```
url_scan.php
```

Replace

```php
$VT_API_KEY="YOUR_VT_API_KEY";
```

with

```php
$VT_API_KEY="YOUR_API_KEY";
```

Get your API key from

https://www.virustotal.com/

---

## URL Processing

The application automatically:

### Normalizes

```
google.com

↓

http://google.com
```

### Defangs

```
https://google.com

↓

hxxps://google[.]com
```

This prevents accidental clicks while sharing IOCs.

---

## Verdict Logic

| VirusTotal Result | Verdict |
|------------------|----------|
| Malicious > 5 | Malicious |
| Malicious > 0 OR Suspicious > 0 | Suspicious |
| Otherwise | Clean |

---

## Features for SOC Analysts

✔ IOC enrichment

✔ Safe IOC sharing

✔ Threat hunting support

✔ Phishing investigation

✔ Email analysis

✔ Incident response

✔ Blue Team workflow

---

## Current Limitations

- Uses VirusTotal public API
- Subject to API rate limits
- URL scanning only
- No authentication
- No history storage
- No export formats besides copy

---

## Future Improvements

- PDF report generation
- CSV export
- Multi-engine reputation
- AbuseIPDB integration
- URLScan.io integration
- OpenPhish integration
- ThreatFox integration
- Bulk API queue
- Analyst notes
- IOC history
- Authentication
- Dashboard statistics

---

## API Used

VirusTotal v3

https://developers.virustotal.com/reference

---

## Security Notice

This project only queries public reputation information.

Never expose your VirusTotal API key publicly.

Store it securely before deploying to production.

---

## License

MIT License

---

## Author

**Sanjay Kotabagi**

SOC Analyst

GitHub

https://github.com/SanjayKotabagi

LinkedIn

https://linkedin.com/in/sanjaykotabagi

---

## Contributing

Pull requests are welcome.

For major changes, please open an issue first to discuss your proposed improvements.

---

## Star the Repository

If you found this project useful, consider giving it a ⭐ to support future cybersecurity tools.
