<?php

namespace Elementor;

class Limay_Banner extends Widget_Base
{

  public function get_name()
  {
    return 'limay-banner';
  }

  public function get_title()
  {
    return 'Limay Banner';
  }

  public function get_icon()
  {
    return 'dashicons dashicons-slides';
  }

  public function get_categories()
  {
    return ['general'];
  }

  public function __construct($data = [], $args = null)
  {
    parent::__construct($data, $args);
    wp_register_style('limay-banner', LIMAY_T_URI . '/widgets/banner/assets/css/banner.min.css');

    wp_register_script(
      'limay-banner',
      LIMAY_T_URI . '/widgets/banner/assets/js/banner.min.js',
      '',
      true
    );
  }

  public function get_script_depends()
  {
    return ['limay-banner'];
  }

  public function get_style_depends()
  {
    return ['limay-banner'];
  }

  protected function _register_controls()
  {

    $this->start_controls_section(
      'section_content',
      [
        'label' => esc_html__('Content', 'limay'),
      ]
    );

    $this->add_control(
      'media',
      [
        'label'       => esc_html__('Media Desktop', 'limay'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'placeholder' => esc_html__('Select image', 'limay'),
        'show_label' => false,
        'default' => [
          'url' => \Elementor\Utils::get_placeholder_image_src(),
        ],
      ]
    );

    $this->add_control(
      'media_mb',
      [
        'label'       => esc_html__('Media Mobile', 'limay'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'placeholder' => esc_html__('Select image', 'limay'),
        'show_label' => false,
        'default' => [
          'url' => \Elementor\Utils::get_placeholder_image_src(),
        ],
      ]
    );

    $this->add_control(
      'title',
      [
        'label' => esc_html__('Title', 'limay'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'default' => esc_html__('Default Title', 'limay'),
        'placeholder' => esc_html__('Type your title here', 'limay'),
        'label_block' => true,
      ]
    );

    $this->add_control(
      'description',
      [
        'label' => esc_html__('Description', 'limay'),
        'type' => \Elementor\Controls_Manager::WYSIWYG,
        'rows' => 10,
        'default' => esc_html__('Default Description', 'limay'),
        'placeholder' => esc_html__('Type your description here', 'limay'),
      ]
    );


    $this->end_controls_section();
  }

  protected function render()
  {

    $settings = $this->get_settings_for_display();

?>
    <div class="limay-banner">
      <div class="limay-banner__container">
        <div class="limay-banner__img" data-an="true" data-anDelay="200">
          <div id="lora"></div>
        </div>

        <div class="limay-banner__media" style="display: none;" data-an="true">
          <?php echo wp_get_attachment_image($settings['media_mb']['id'], 'full', array('loading' => 'lazy',)); ?>
        </div>

        <div class="limay-banner__content" data-an="true" data-anDelay="600">
          <h1 class="hero"><?= $settings['title'] ?></h1>

          <?php if (!empty($settings['description'])) { ?>
            <div class="limay-banner__content-desc">
              <?= $settings['description'] ?>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>

    <?php if (!empty($settings['media']) && count($settings['media'])) { ?>
      <script type="module">
        var lora = "<?= $settings['media']['url'] ?>";
        import {
          Renderer,
          Camera,
          Transform,
          Box,
          Program,
          Vec2,
          Vec4,
          Flowmap,
          Geometry,
          Texture,
          Mesh
        } from "https://unpkg.com/ogl";

        {

          const c = [2500, 1406];
          const i = new Renderer({
            dpr: 2,
            alpha: !0
          });
          const gl = i.gl;
          document.getElementById('lora').appendChild(gl.canvas), gl.clearColor(.1, .1, .1, 1);
          let n = 1;
          const o = new Vec2(-1),
            r = new Vec2;

          function e() {
            let e, t;
            const trt = c[1] / c[0];
            window.innerHeight / window.innerWidth < trt ? (e = 1, t = window.innerHeight / window.innerWidth / trt) : (e = window.innerWidth / window.innerHeight * trt, t = 1), b.program.uniforms.res.value = new Vec4(window.innerWidth, window.innerHeight, e, t), i.setSize(window.innerWidth, window.innerHeight), n = window.innerWidth / window.innerHeight
          }

          const s = new Flowmap(gl, {
              falloff: 1,
              alpha: .3,
              dissipation: .94
            }),
            d = new Geometry(gl, {
              position: {
                size: 2,
                data: new Float32Array([-1, -1, 3, -1, -1, 3])
              },
              uv: {
                size: 2,
                data: new Float32Array([0, 0, 2, 0, 0, 2])
              }
            }),
            h = new Texture(gl, {
              minFilter: gl.LINEAR,
              magFilter: gl.LINEAR
            });
          gl.clear(gl.COLOR_BUFFER_BIT);
          const g = new Image;
          let f, u;
          g.onload = () => {
            h.image = g, x.uniforms.alpha.value = 1
          }, g.crossOrigin = "Anonymous", g.src = "" + lora;
          const w = c[1] / c[0];
          window.innerHeight / window.innerWidth < w ? (f = 1, u = window.innerHeight / window.innerWidth / w) : (f = window.innerWidth / window.innerHeight * w, u = 1);
          const x = new Program(gl, {
              vertex: "\nattribute vec2 uv;\nattribute vec2 position;\nvarying vec2 vUv;\nvoid main() {\n  vUv = uv;\n  gl_Position = vec4(position, 0, 1);\n}",
              fragment: "\nprecision highp float;\nprecision highp int;\nuniform sampler2D tWater;\nuniform sampler2D tFlow;\nuniform float uTime;\nvarying vec2 vUv;\nuniform float alpha;\nuniform vec4 res;\nvoid main() {\n  vec3 flow = texture2D(tFlow, vUv).rgb;\n  vec2 uv = .5 * gl_FragCoord.xy / res.xy ;\n  vec2 myUV = (uv - vec2(0.5))*res.zw + vec2(0.5);\n  myUV -= flow.xy * (0.15 * 0.7);\n  vec2 myUV2 = (uv - vec2(0.5))*res.zw + vec2(0.5);\n  myUV2 -= flow.xy * (0.125 * 0.7);\n  vec2 myUV3 = (uv - vec2(0.5))*res.zw + vec2(0.5);\n  myUV3 -= flow.xy * (0.10 * 0.7);\n  vec3 tex = texture2D(tWater, myUV).rgb;\n  vec3 tex2 = texture2D(tWater, myUV2).rgb;\n  vec3 tex3 = texture2D(tWater, myUV3).rgb;\n  gl_FragColor = vec4(tex.r, tex2.g, tex3.b, alpha);\n}",
              uniforms: {
                uTime: {
                  value: 0
                },
                tWater: {
                  value: h
                },
                res: {
                  value: new Vec4(window.innerWidth, window.innerHeight, f, u)
                },
                img: {
                  value: new Vec2(c[0], c[1])
                },
                tFlow: s.uniform,
                alpha: {
                  value: 0
                }
              }
            }),
            b = new Mesh(gl, {
              geometry: d,
              program: x
            });
          e();
          // Create handlers to get mouse position and velocity
          const isTouchCapable = 'ontouchstart' in window;
          if (isTouchCapable) {
            window.addEventListener('touchstart', updateMouse, false);
            window.addEventListener('touchmove', updateMouse, false);
          } else {
            window.addEventListener('mousemove', updateMouse, false);
          }


          let lastTime;
          const lastMouse = new Vec2();

          function updateMouse(e) {
            if (e.changedTouches && e.changedTouches.length) {
              e.x = e.changedTouches[0].pageX;
              e.y = e.changedTouches[0].pageY;
            }
            if (e.x === undefined) {
              e.x = e.pageX;
              e.y = e.pageY;
            }

            // Get mouse value in 0 to 1 range, with y flipped
            o.set(e.x / gl.renderer.width, 1.0 - e.y / gl.renderer.height);

            // Calculate velocity
            if (!lastTime) {
              // First frame
              lastTime = performance.now();
              lastMouse.set(e.x, e.y);
            }

            const deltaX = e.x - lastMouse.x;
            const deltaY = e.y - lastMouse.y;

            lastMouse.set(e.x, e.y);

            let time = performance.now();

            // Avoid dividing by 0
            let delta = Math.max(14, time - lastTime);
            lastTime = time;

            r.x = deltaX / delta;
            r.y = deltaY / delta;

            // Flag update to prevent hanging velocity values when not moving
            r.needsUpdate = true;
          }

          requestAnimationFrame(update);

          function update(t) {
            requestAnimationFrame(update);

            // Reset velocity when mouse not moving
            if (!r.needsUpdate) {
              o.set(-1);
              r.set(0);
            }
            r.needsUpdate = false;

            // Update s inputs
            s.aspect = n;
            s.mouse.copy(o);

            // Ease velocity input, slower when fading out
            s.velocity.lerp(r, r.len() ? 0.3 : 0.4);

            s.update();

            x.uniforms.uTime.value = t * 0.001;

            i.render({
              scene: b
            });
          }
        }
      </script>
    <?php } ?>
<?php
  }
}
