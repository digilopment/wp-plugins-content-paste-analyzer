# Content Paste Analyzer

**Plugin na detekciu problematického HTML pri vkladaní obsahu do WordPress postov.**

---

## Popis

Content Paste Analyzer kontroluje, či obsah článkov obsahuje neželané root obalovacie elementy (napr. `<div>`, `<article>`, `<section>`), ktoré môžu vzniknúť pri kopírovaní obsahu z externých zdrojov.  
Plugin ignoruje legitímne embedy ako `<iframe>`, `<script>` alebo `<blockquote>`.

---

## Funkcie

- Detekuje, či je celý obsah článku obalený root elementom.  
- Označí články s problematickým HTML cez post meta `_cpa_dirty_html`.
- Označí články do kotrých bol pastnutý HTML content cez post meta `_cpa_pasted_html`.  
- Zobrazuje admin notifikácie pri uložení problematického obsahu.  
- Integruje sa s WordPress Classic Editorom (vyžaduje jeho aktiváciu).  
- Poskytuje administračný náhľad na problematické články cez vlastnú admin stránku pre `_cpa_dirty_html` aj `_cpa_pasted_html` 

---

## Inštalácia

1. Skopírujte plugin do adresára `wp-content/plugins/content-paste-analyzer`.  
2. Aktivujte plugin cez WordPress admin rozhranie.  
3. Uistite sa, že je aktívny plugin [Classic Editor](https://wordpress.org/plugins/classic-editor/).  

---

## Použitie

- Plugin automaticky kontroluje obsah pri ukladaní postov typu `post`.  
- Problematic posts sú označené meta key `_cpa_dirty_html = 1`.  
- Pasted posts sú označené meta key `_cpa_pasted_html = 1`.  
- AdminNotices zobrazí upozornenie pre editora.  

---

## Developer

- Namespace: `CPA\Core`  
- Hlavná validačná trieda: `ContentValidator`  
- Admin interakcia: `AdminNotice`, `PasteAdminPage`, `SuspectAdminPage`, `PasteDetector`  

---

## Testovanie

- Unit testy sa nachádzajú v `tests/` a používajú PHPUnit 12.  
- Testujú hlavne `ContentValidator::isValidArticle()` na príkladoch HTML súborov z `tests/articles/` (prefixy `ok-` a `bad-`).  

Spustenie testov a statickej analýzy:

```bash
vendor/bin/phpunit
vendor/bin/phpstan
```
