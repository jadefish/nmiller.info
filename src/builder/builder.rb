require 'optparse'
require 'erb'
require 'pandoc-ruby'

def parse_options(args, defaults = {})
    result = defaults

    OptionParser.new do |parser|
        parser.banner = 'Usage: builder.rb [options]'
        parser.on('-d', '--docs_dir=DOCS_DIR', 'directory containing markdown documents')
        parser.on('-w', '--wrapper=WRAPPER', 'path to HTML wrapper template')
        parser.on('-o', '--out_dir=OUT_DIR', 'directory to which rendered templates are written')
        parser.on('--help', 'prints this help') { puts parser } 
    end.parse(args, into: result)

    result
end

def file_path(*fragments, base: Dir.pwd)
    File.join(base, *fragments)
end

def exit_with(message, code: 1) 
    STDERR.puts(message)
    exit(code)
end

def main(argc, argv)
    options = parse_options(argv,
        docs_dir: 'md',
        out_dir: 'out'
    )

    return exit_with("missing option: --wrapper") if !options.key?(:wrapper)

    wrapper = file_path(options[:wrapper])
    wrapperer = ERB.new(File.read(file_path(options[:wrapper])))

    Dir.glob('**/*.md', base: options[:docs_dir]).each do |file|
        dir_fragment = File.dirname(file)
        markdown_file = file_path(options[:docs_dir], file)
        markdown = File.read(markdown_file)
        content = PandocRuby.convert(markdown, from: :gfm, to: :html)
        basename = File.basename(file, '.*')
        html = wrapperer.result_with_hash(
            source: file,
            year: Time.now.utc.year,
            title: basename,
            content: content
        )

        out_dir = file_path(File.basename(options[:out_dir]), dir_fragment)
        FileUtils.mkdir_p(out_dir)
        out_file = File.join(out_dir, "#{basename}.html")

        File.open(out_file, 'w') do |f|
            f.write(html)
        end
    end
end

main(ARGV.length, ARGV)
