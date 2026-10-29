JEJA VISION CHURCH / STUDIO8 — v16 preview

[PC local preview]
1. Extract all files from the ZIP. Keep the assets and api folders.
2. Double-click start-local.bat. PHP 8 / XAMPP must be installed.
3. Browser opens http://127.0.0.1:8777/
4. For the automatic latest YouTube video list, the PC needs internet access.

If PHP is not found, copy the entire disciple-vision-site folder under your
XAMPP htdocs directory, start Apache, and open:
http://localhost/disciple-vision-site/

Opening index.html directly (file://) is possible for layout review only.
YouTube may refuse embedded playback without a normal HTTP origin/referrer.
The page then provides a direct official YouTube channel link.

[Cafe24 PHP 8.x deployment]
1. Upload the CONTENTS of this directory to the desired site path.
2. Keep api/latest-videos.php and all asset files in their relative paths.
3. Open the hosted HTTPS site. The PHP endpoint requests the official public
   YouTube channel RSS feed and caches results for 15 minutes.
4. Verify https://YOUR-DOMAIN/api/latest-videos.php returns JSON. The
   response must have ok=true and one or more items to show live latest data.
5. If ok=false, confirm outbound HTTPS/cURL and SimpleXML support in hosting.
   The main page will fall back to a verified older sermon and offer a direct
   link to the official channel.

[Design assets]
assets/jeja-vision-logo.svg: newly designed vector website logo concept,
not yet an officially adopted church logo.
assets/church-hero-wide.png: AI-assisted wide illustration based on actual
church reference photograph, first slide. It is not a documentary photo.
assets/slide-bible.png, slide-worship.png, slide-nextgen.png,
slide-community.png: AI-generated illustrative hero photographs.
assets/church-front.jpg: actual supplied church photograph.
assets/church-bulletin-photo.jpg: original bulletin, used to display the exact
October 11, 2026 bulletin in the weekly-bulletin modal.

The weekly bulletin is an attached historical sample (2026-10-11), NOT
automatically updated or claimed to be the current week. Church news items
are from that sample's stated theme and practice notes. Replace with verified
current church data when CMS integration is implemented.

[v6 visual and interaction updates]
- The bulletin and news appear immediately below the hero as a split,
  diagonal burgundy/navy strip inspired by the supplied screenshot.
- Recent sermon cards use a warm charcoal/walnut palette to coordinate
  with the worship information area.
- Two bottom-right fixed shortcuts: Church News scrolls to the split strip;
  Weekly Bulletin opens the full-size supplied bulletin in a dialog.

[v7 visual refinement]
- The burgundy bulletin panel is deliberately positioned lower and the navy
  church-news panel higher, with a correctly angled diagonal interface.
- The deep navy background continues directly into the video section and
  gradually blends toward warm charcoal/walnut around recent sermon cards.
- Mobile layout stacks both blocks without clipping or overlap.

[v8 palette and sermon]
- Simplified wine (#4E2439) / deep navy (#102D40) split cards and reduced
  stagger to create a more consistent reference-inspired visual.
- The weekly/news-to-sermon transition is now one cohesive navy palette;
  sermon cards use a complementary slate blue and the following quick links
  use restrained warm ivory.
- A verified real church sermon (2026-09-20, gYKITs6ASeA) appears as a
  visible playable YouTube thumbnail when opened directly via file://.
  Latest-video automatic selection still requires PHP hosting, outbound RSS
  access, and YouTube embedding permissions.

[v9 layout restoration]
- Weekly bulletin and church news are once again flush side-by-side, without
  diagonal clipping or staggered heights.
- Main sermon presentation uses warm ivory (#F5F0E8).
- The recent sermon video cards have a dark Bible-photo backdrop and light
  outlined cards, corresponding to the restored worship presentation.
- Removed the three ministry cards directly after recent sermons.
- The Worship section once again presents introductory text and four tall
  worship-time cards with warm brown image overlays.

[v10 pastor foreground]
- A high-resolution (1206 x 1305 px) transparent PNG cutout of the pastor
  behind the pulpit appears as a separate top-level foreground on the right
  side of the full-width hero.
- The pastor/pulpit remains stationary while the five background slides and
  their accompanying messages change every six seconds.
- The cutout is generated from a very small livestream screenshot, so facial
  details have been reconstructed and should be approved before final use.
- Responsive CSS adjusts foreground height and location for tablet/mobile.
- Source asset: assets/pastor-pulpit-transparent.png

[v11 pastor foreground sizing]
- Reduced the pastor/pulpit foreground display height to 50% of the v10
  desktop, tablet, and mobile sizes. Original transparent PNG is unchanged.
- The foreground remains fixed above the rotating background slides.

[v12 design and YouTube updates]
- Pastor/pulpit overlay is 20% larger than v11 at every responsive breakpoint.
- White pen-style "담임목사 김진규" lettering overlays the pulpit; its font
  loads from Google Fonts when internet access is available.
- About-section image changes to the existing community-themed illustration.
- Directions section uses a Google Maps embedded map background for the church
  address, with a Naver Maps link to open the map interactively. An internet
  connection is required for the background map.
- Floating news and bulletin shortcuts use bright teal and coral respectively.
- The official channel's most recent public uploads populate the main sermon
  player and four recent-video cards on PHP 8.x hosts. Last successfully cached
  feed is shown if a subsequent YouTube RSS request temporarily fails.

[v13 independent pastor signature]
- "담임목사" label and large brush-pen-style "김진규" name are rendered in a
  separate fixed foreground layer above the pastor image and rotating slides.
- The handwriting is a decorative text treatment, not a reproduction of the
  pastor's actual handwritten legal signature.

[v14 pulpit cropping and black pen-style signature]
- Lowered the pastor/pulpit foreground by 65px on desktop and about 30px on
  mobile so less of the pulpit extends above the hero's lower edge.
- Smaller "담임목사" label, flowing one-line "김진규" in slim black pen-style
  lettering. The signature remains its own foreground layer.

[v15 pastor positioning]
- Removed the separate pastor-name/signature layer entirely.
- Increased the original transparent pastor/pulpit asset's displayed size by
  10% compared with v14 across desktop, tablet and mobile.
- Moved the foreground further down so only a small upper part of the pulpit
  remains visible in the hero. The source transparent PNG is unchanged.

[v16 cinematic hero transitions]
- The five hero photos now change with a 1.35-second directional image reveal
  and gentle zoom/slide, rather than a simple fade.
- Headline, introduction, verse and links enter in a staggered upward motion.
- The pastor foreground remains stationary over the transition.
- Manual slide dots, 6-second autoplay and the pause control remain active.
- Reduced-motion device settings disable decorative transition animations.

The website remains a design MVP. Menu subpages/CMS are not yet implemented.
