<?php

/*	EPP Client class for PHP, Copyright 2005 CentralNic Ltd
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

/**
 * Low-level functions useful for both EPP clients and servers
 *
 * @version 0.0.4
 *
 * @author Gavin Brown <gavin.brown@nospam.centralnic.com>
 *
 * @revision $Id: Protocol.php,v 1.4 2011/06/28 09:48:02 gavin Exp $
 */

/**
 * Low-level functions useful for both EPP clients and servers
 */
class Net_EPP_Protocol
{
    public static function _fread_nb($socket, $length)
    {
        $result = '';

        // Loop reading and checking info to see if we hit timeout
        $info = stream_get_meta_data($socket);
        $time_start = microtime(true);

        while (! $info['timed_out'] && ! feof($socket)) {
            // Try read remaining data from socket
            $buffer = @fread($socket, $length - strlen($result));
            // If the buffer actually contains something then add it to the result
            if ($buffer !== false) {
                $result .= $buffer;
                // If we hit the length we looking for, break
                if (strlen($result) == $length) {
                    break;
                }
            } else {
                // Sleep 0.25s
                usleep(250000);
            }
            // Update metadata
            $info = stream_get_meta_data($socket);
            $time_end = microtime(true);
            if (($time_end - $time_start) > 10) {
                throw new exception('Timeout while reading from EPP Server');
            }
        }
        // Check for timeout
        if ($info['timed_out']) {
            throw new Exception('Timeout while reading data from socket');
        }

        return $result;
    }

    public static function _fwrite_nb($socket, $buffer, $length)
    {
        // Loop writing and checking info to see if we hit timeout
        $info = stream_get_meta_data($socket);
        $time_start = microtime(true);

        $pos = 0;
        while (! $info['timed_out'] && ! feof($socket)) {
            // Some servers don't like alot of data, so keep it small per chunk
            $wlen = $length - $pos;
            if ($wlen > 1024) {
                $wlen = 1024;
            }
            // Try write remaining data from socket
            $written = @fwrite($socket, substr($buffer, $pos), $wlen);
            // If we read something, bump up the position
            if ($written && $written !== false) {
                $pos += $written;
                // If we hit the length we looking for, break
                if ($pos == $length) {
                    break;
                }
            } else {
                // Sleep 0.25s
                usleep(250000);
            }
            // Update metadata
            $info = stream_get_meta_data($socket);
            $time_end = microtime(true);
            if (($time_end - $time_start) > 10) {
                throw new exception('Timeout while writing to EPP Server');
            }
        }
        // Check for timeout
        if ($info['timed_out']) {
            throw new Exception('Timeout while writing data to socket');
        }

        return $pos;
    }

    /**
     * get an EPP frame from the remote peer
     *
     * @param  resource  $socket  a socket connected to the remote peer
     * @return string the frame
     *
     * @throws Exception on frame errors.
     */
    public static function getFrame($socket)
    {
        // Read header
        $hdr = Net_EPP_Protocol::_fread_nb($socket, 4);
        if (strlen($hdr) < 4) {
            throw new Exception(sprintf('Short read of %d bytes from peer', strlen($hdr)));
        }

        // Unpack first 4 bytes which is our length
        $unpacked = unpack('N', $hdr);
        $length = $unpacked[1];
        if ($length < 5) {
            throw new Exception(sprintf('Got a bad frame header length of %d bytes from peer', $length));
        } else {
            $length -= 4; // discard the length of the header itself

            // Read frame
            return Net_EPP_Protocol::_fread_nb($socket, $length);
        }
    }

    /**
     * send an EPP frame to the remote peer
     *
     * @param  resource  $socket  a socket connected to the remote peer
     * @param  string  $xml  the XML to send
     * @return the amount of bytes written to the frame
     *
     * @throws Exception when it doesn't complete the write to the socket
     */
    public static function sendFrame($socket, $xml)
    {
        // Grab XML length & add on 4 bytes for the counter
        $length = strlen($xml) + 4;
        $res = Net_EPP_Protocol::_fwrite_nb($socket, pack('N', $length).$xml, $length);
        // Check our write matches
        if ($length != $res) {
            throw new Exception('Short write when sending XML');
        }

        return $res;
    }
}
